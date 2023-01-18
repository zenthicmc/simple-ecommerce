<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Support\Env;
use Inertia\Inertia;
use App\Models\Review;
use App\Http\Controllers\Payment\TripayController;

class FrontController extends Controller
{
    public function index()
    {
        $review = Review::all();
        return Inertia::render('Home', [
			'title' => 'Home',
            'merchant' => Env::get('APP_NAME'),
            'products' => Product::all(),
            'reviews' => $review,
            'count_transactions' => count(Transaction::where('status', 'PAID')->get()),
            'average_review' => floor($review->avg('star')),
            'count_review' => count($review),
		]);
    }

    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $stocks = Stock::where('id_product', $product->id)->where('available', 'true')->get();
        return Inertia::render('Detail', [
            'title' => 'Detail',
            'merchant' => Env::get('APP_NAME'),
            'product' => $product,
            'count_stocks' => count($stocks),
            'stocks' => $stocks,
            'count_transactions' => count(Transaction::where('status', 'PAID')->where('id_product', $product->id)->get()),
        ]);
    }

    public function checkout($id_product, $quantity) {
        $product = Product::where('id', $id_product)->first();
        $tripay = new TripayController();

        if(!$product) {
            abort(404);
        }

        return Inertia::render('Checkout', [
            'title' => 'Checkout',
            'merchant' => Env::get('APP_NAME'),
            'product' => $product,
            'quantity' => $quantity,
            'methods' => $tripay->getPaymentChannels(),
        ]);
    }

    public function redirect($reference) {
        return Inertia::render('Redirect', [
            'title' => 'Redirect',
            'merchant' => Env::get('APP_NAME'),
            'reference' => $reference,
        ]);
    }

    public function success() {
        return Inertia::render('Success', [
            'title' => 'Success',
            'merchant' => Env::get('APP_NAME'),
        ]);
    }

    public function api_product($filter) {
        if ($filter == 'default') {
            $products = Product::all();
        } else if ($filter == 'popular') {
            // get product with most transaction with subquery
            $products = Product::select('products.*')
                ->join('transactions', 'products.id', '=', 'transactions.id_product')
                ->groupBy('products.id')
                ->orderByRaw('COUNT(products.id) DESC')
                ->union(Product::select('products.*')
                    ->whereNotIn('products.id', function($query) {
                        $query->select('id_product')->from('transactions');
                    })
                )
                ->get();

        } else if ($filter == 'high') {
            $products = Product::orderBy('price', 'asc')->get();
        } else if ($filter == 'low') {
            $products = Product::orderBy('price', 'desc')->get();
        } else {
            $products = Product::orderBy('created_at', 'desc')->get();
        }

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }
}
