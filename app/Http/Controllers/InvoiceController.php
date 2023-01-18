<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class InvoiceController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Admin | Invoices',
            'transactions' => Transaction::all()->where('status', '!=', 'PAID')->sortByDesc('created_at'),
        ];
        return view('dashboard.admin-invoice', $data);
    }

    public function edit($reference)
    {
        $data = [
            'title' => 'Admin | Invoice',
            'transaction' => Transaction::where('reference', $reference)->first(),
        ];
        return view('dashboard.admin-invoice-edit', $data);
    }

    public function edit_store(Request $request, $reference)
    {
        $transaction = Transaction::where('reference', $reference)->first();
        $transaction->status = $request->status;
        $transaction->save();

        return redirect()->route('admin.invoice')->with('success', 'Invoice status updated');
    }

    public function delete($reference)
    {
        $transaction = Transaction::where('reference', $reference)->first();
        $transaction->delete();
        return redirect()->back()->with('success', 'Invoice deleted successfully');
    }
}
