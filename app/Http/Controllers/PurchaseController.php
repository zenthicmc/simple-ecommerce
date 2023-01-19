<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\Transaction;

class PurchaseController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Admin | Purchases',
            'transactions' => Transaction::all()->where('status', '==', 'PAID')->sortByDesc('created_at'),
        ];
        return view('dashboard.admin-purchase', $data);
    }

    public function edit($reference)
    {
        $data = [
            'title' => 'Admin | Purchases',
            'transaction' => Transaction::where('reference', $reference)->first(),
        ];
        return view('dashboard.admin-purchase-edit', $data);
    }

    public function edit_store(Request $request, $reference)
    {
        $transaction = Transaction::where('reference', $reference)->first();
        $stock = Stock::where('id', $transaction->id_stock)->first();

        $transaction->status = $request->status;
        $stock->content = $request->stock;
        $transaction->save();
        $stock->save();

        return redirect()->route('admin.purchase')->with('success', 'Purchase status updated');
    }

    public function delete($reference)
    {
        $transaction = Transaction::where('reference', $reference)->first();
        $transaction->delete();
        return redirect()->back()->with('success', 'Purchase deleted successfully');
    }
}
