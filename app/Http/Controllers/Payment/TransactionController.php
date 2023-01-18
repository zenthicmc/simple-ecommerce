<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\TripayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        $stocks = Stock::where('id_product', $product->id)->where('available', 'true')->get();
        $tripay = new TripayController();


        // check apakah stok mencukupi sebelum checkout
        if($request->quantity > count($stocks)) {
            return redirect()->back()->with('error', 'Maaf, stok tidak mencukupi');
        }
        if($request->quantity == '0') {
            return redirect()->back()->with('error', 'Maaf, angka tidak boleh 0');
        }

        $data = [
            'title' => 'Checkout',
            'product' => $product,
            'quantity' => $request->quantity,
            'payment_channels' => $tripay->getPaymentChannels(),
        ];
        return view('checkout', $data);
    }

    public function show($reference)
    {
        $transaction = Transaction::where('reference', $reference)->first();
        $id_product = Product::where('id', $transaction->id_product)->first()->id;

        if($transaction->id_user != Auth::user()->id) {
            abort(404);
        }

        $tripay = new TripayController();
        $detail = $tripay->detailTransaction($reference);

        $data = [
            'title' => 'Transaction Detail',
            'detail' => $detail,
            'id_product' => $id_product,
            'transactionStock' => $transaction->stock,
        ];

        return view('transaction', $data);
    }


    public function store(Request $request)
    {
        $tripay = new TripayController();
        $stocks = Stock::where('id_product', $request->id_product)->where('available', 'true')->get();
        $product = Product::where('id', $request->id_product)->first();

        // custom validation message
        $messages = [
            'quantity.max' => 'Maaf, stok tidak mencukupi',
            'id_product.exists' => 'Maaf, produk tidak ditemukan',
            'total.gte' => 'Maaf, total harga tidak sesuai: ' . $request->total,
        ];

        // custom validation
        $data = $request->validate([
            'id_product' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1|max:'.count($stocks),
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'method' => 'required',
            'total' => 'required|gte:'.$product->price * $request->quantity,
        ], $messages);


        // Request to Tripay
        $tripay = new TripayController();
        $transaction = $tripay->requestTransaction($product->name, $data['total'], $data['quantity'], $product->image, $data['method'], $product->price, $data['fullname'], $data['email'], $data['phone']);

        // Create a new data in Transaction model
        Transaction::create([
            'id_product' => $product->id,
            'email' => $data['email'],
            'name' => $data['fullname'],
            'phone' => $data['phone'],
            'reference' => $transaction->reference,
            'merchant_ref' => $transaction->merchant_ref,
            'price' => $transaction->amount,
            'quantity' => $data['quantity'],
            'method' => $transaction->payment_method,
            'status' => $transaction->status,
            'link' => $transaction->checkout_url,
        ]);

        // return data
        return redirect()->route('redirect', ['reference' => $transaction->reference]);
    }

    public function transaction_api($reference)
    {
        $tripay = new TripayController();
        $transaction = $tripay->detailTransaction($reference);

        return response()->json($transaction->status);
    }
}