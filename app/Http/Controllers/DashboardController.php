<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'recent_products' => Product::all()->sortByDesc('created_at')->take(5),
            'products' => Product::all(),
            'stocks' => Stock::all()->where('available', '==', 'true'),
            'categories' => Category::all(),
            'total_income' => Transaction::all()->where('status', 'PAID')->sum('price'),
            'pending_transactions' => count(Transaction::all()->where('status', '==', 'PENDING')),
            'paid_transactions' => count(Transaction::all()->where('status', '==', 'PAID')),
            'unpaid_transactions' => count(Transaction::all()->where('status', '==', 'UNPAID')),
            'total_spend' => Transaction::all()->where('status', '==', 'PAID')->where('id_user', '==', Auth::user()->id)->sum('price'),
            'user_pending_transactions' => count(Transaction::all()->where('status', '==', 'PENDING')->where('id_user', '==', Auth::user()->id)),
            'user_paid_transactions' => count(Transaction::all()->where('status', '==', 'PAID')->where('id_user', '==', Auth::user()->id)),
            'user_unpaid_transactions' => count(Transaction::all()->where('status', '==', 'UNPAID')->where('id_user', '==', Auth::user()->id)),
            'total_users' => count(User::all()),
        ];
        return view('dashboard.index', $data);
    }

    public function invoice()
    {
        $data = [
            'title' => 'My Invoices',
            'transactions' => Transaction::all()->where('status', '!=', 'PAID')->where('id_user', '==', Auth::user()->id),
        ];
        return view('dashboard.invoice', $data);
    }

    public function purchase()
    {
        $data = [
            'title' => 'My Purchases',
            'transactions' => Transaction::all()->where('status', '==', 'PAID')->where('id_user', '==', Auth::user()->id),
        ];
        return view('dashboard.purchase', $data);
    }

    public function purchase_view($reference) {
        $transaction = Transaction::where('reference', $reference)->first();

        if($transaction->id_user != Auth::user()->id) {
            abort(404);
        }

        $data = [
            'title' => 'Purchase',
            'transaction' => $transaction,
        ];
        return view('dashboard.purchase_view', $data);
    }

    public function profile()
    {
        $data = [
            'title' => 'My Profile',
            'user' => Auth::user(),
        ];
        return view('dashboard.profile', $data);
    }

    public function profile_update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->name != $user->name ? $rules_name = $rules_name = ['required', 'string', 'max:255', 'unique:users'] : $rules_name = ['required', 'string', 'max:255'];
        $request->email != $user->email ? $rules_email = ['required', 'string', 'email', 'max:255', 'unique:users'] : $rules_email = ['required', 'string', 'email', 'max:255'];
        $request->pwd ? $rules_pwd = ['required', Rules\Password::defaults()] : $rules_pwd = [];
        $request->pwd_cnfrm ? $rules_pwd_cnfrm = ['required', 'same:pwd'] : $rules_pwd_cnfrm = [];

        $request->validate([
            'name' => $rules_name,
            'email' => $rules_email,
            'pwd' => $rules_pwd,
            'pwd_cnfrm' => $rules_pwd_cnfrm,
        ]);

        $request->pwd ? $value_pwd = Hash::make($request->pwd) : $value_pwd = $user->password;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $value_pwd,
        ]);
        return redirect()->route('profile')->with('success', 'Your profile has been updated successfully');
    }
}
