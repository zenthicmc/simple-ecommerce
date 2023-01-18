<?php

use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use App\Models\Transaction;

if(!function_exists('countProductByIdCategory')) {
   function countProductByIdCategory($id_category)
   {
      if($id_category == 0) {
         $products = Product::all();
      }
      else {
         $products = Product::where('id_category', $id_category)->get();
      }

      return count($products);
   }
}


if(!function_exists('countStockByIdProduct')) {
   function countStockByIdProduct($id_product)
   {
      $stocks = Stock::where('id_product', $id_product)->where('available', 'true')->get();
      return count($stocks);
   }
}

if(!function_exists('countPurchaseByIdProduct')) {
   function countPurchaseByIdProduct($id_product)
   {
      $transactions = Transaction::where('id_product', $id_product)->where('status', 'PAID')->get();
      return count($transactions);
   }
}

if(!function_exists('countPurchaseByIdUser')) {
   function countPurchaseByIdUser($id_user)
   {
      $transactions = Transaction::where('id_user', $id_user)->where('status', 'PAID')->get();
      return count($transactions);
   }
}

if(!function_exists('getUserById')) {
   function getUserById($id_user)
   {
      $user = User::find($id_user)->name;
      return $user;
   }
}

if(!function_exists('getStock')) {
   function getStock($id_product, $amount, $reference) {
      $transaction = Transaction::where('reference', $reference)->first();
      $stock_array = [];
      if(empty($transaction->stock))
      {
         if(count(Stock::where('id_product', $id_product)->where('available', 'true')->get()) < $amount) {
            $transaction->status = 'PENDING';
            return [];
         }
   
         while($amount > 0) {
            $stocks = Stock::where('id_product', $id_product)->where('available', 'true')->first();
            if($stocks->isUnlimited == 'false') {
               $stocks->available = 'false';
            }
            $stocks->save();
            array_push($stock_array, $stocks->content);
            $amount = $amount - 1;
            $transaction->stock = $transaction->stock . $stocks->content . '';
            $transaction->save();
         }
      }
      return $stock_array;
   }
}
