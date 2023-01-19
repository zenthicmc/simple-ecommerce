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
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

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
            'average_review' => $review->avg('star'),
            'count_review' => count($review),
		]);
    }

    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $stocks = Stock::where('id_product', $product->id)->where('available', 'true')->get();
        $review = Review::where('id_product', $product->id)->get();
        return Inertia::render('Detail', [
            'title' => 'Detail',
            'merchant' => Env::get('APP_NAME'),
            'product' => $product,
            'count_stocks' => count($stocks),
            'stocks' => $stocks,
            'count_transactions' => count(Transaction::where('status', 'PAID')->where('id_product', $product->id)->get()),
            'count_review' => count($review),
            'count_star' => $review->avg('star'),
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

    public function success($merchantref) {
        $transaction = Transaction::where('merchant_ref', $merchantref)->first();

        if(!$transaction) {
            abort(404);
        }

        $stock = Stock::where('id', $transaction->id_stock)->first();

        return Inertia::render('Success', [
            'title' => 'Success',
            'merchant' => Env::get('APP_NAME'),
            'transaction' => $transaction,
            'stock' => $stock,
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

    public function review($code) {
        try {
            $decoded = JWT::decode($code, new Key(env('JWT_KEY'), 'HS256'));
            $transaction = Transaction::where('reference', $decoded->aud)->where('review_code', $code)->first();

            if(!$transaction) {
                abort(404);
            }
            
            return Inertia::render('CreateReview', [
                'title' => 'Create Review',
                'merchant' => Env::get('APP_NAME'),
                'code' => $code,
                'transaction' => $transaction,
            ]);

        } catch (ExpiredException) {
            abort(404);
        }
    }

    public function review_store(Request $request, $code) {
        try {
            $decoded = JWT::decode($code, new Key(env('JWT_KEY'), 'HS256'));
            $transaction = Transaction::where('reference', $decoded->aud)->where('review_code', $code)->first();

            if(!$transaction) {
                abort(404);
            }

            $data = $request->validate([
                'id_product' => 'required|numeric|exists:products,id',
                'name' => 'required|string',
                'star' => 'required|numeric|min:1|max:5',
                'description' => 'required|string',
            ]);

            $review = Review::create([
                'id_product' => $data['id_product'],
                'name' => $data['name'],
                'star' => $data['star'],
                'description' => $data['description'],
            ]);

            if($review) {
                $transaction->review_code = null;
                $transaction->save();

                return redirect()->route('review.success');
            }

        } catch (ExpiredException) {
            abort(404);
        }
    }
    
    public function review_success() {
        return Inertia::render('ReviewSuccess', [
            'title' => 'Review Success',
            'merchant' => Env::get('APP_NAME'),
        ]);
    }
}
