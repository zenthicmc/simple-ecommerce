<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;

class StockController extends Controller
{
   public function index()
   {
      $data = [
      	'title' => 'Admin | Stocks',
      	'stocks' => Stock::all()->sortBy('id_product')->where('available', '==', 'true'),
      ];
      return view('dashboard.stock', $data);
   }

   public function create()
   {
      $data = [
         'title' => 'Admin | Stocks',
         'products' => Product::all(),
      ];
      return view('dashboard.stock_new', $data);
   }

   public function create_store(Request $request)
   {
      $request->validate([
			'id_product' => ['required', 'integer'],
			'isUnlimited' => ['required', 'string', 'max:255'],
			'content' => ['required', 'string', 'max:10000'],
			'expire_at' => ['required', 'date'],
		]);

      Stock::create([
         'code' => 'ST-'. time(),
			'id_product' => $request->id_product,
			'isUnlimited' => $request->isUnlimited,
			'content' => $request->content,
			'expire_at' => $request->expire_at,
		]);

      return redirect()->route('stock')->with('success', 'Stock added successfully');
   }

   public function edit($code)
   {
      $data = [
         'title' => 'Admin | Stocks',
         'products' => Product::all(),
         'stock' => Stock::where('code', $code)->first(),
      ];
      return view('dashboard.stock_edit', $data);
   }

   public function edit_store($code, Request $request)
   {
		$stock = Stock::where('code', $code)->first();
      $request->validate([
			'id_product' => ['required', 'integer'],
			'isUnlimited' => ['required', 'string', 'max:255'],
			'content' => ['required', 'string', 'max:10000'],
			'expire_at' => ['required', 'date'],
      ]);

      $stock->update([
			'id_product' => $request->id_product,
			'isUnlimited' => $request->isUnlimited,
			'content' => $request->content,
			'expire_at' => $request->expire_at,
		]);

		return redirect()->route('stock')->with('success', 'Stock updated successfully');
	}
	
	
   public function delete($code)
   {
      $stock = Stock::where('code', $code)->first();
      $stock->delete();
      return redirect()->route('stock')->with('success', 'Stock deleted successfully');
   }
}
