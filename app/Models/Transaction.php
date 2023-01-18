<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;
use App\Models\Stock;

class Transaction extends Model
{
   use HasFactory;
   protected $table = 'transactions';
   protected $fillable = [
      'id_product',
      'id_stock',
      'email',
      'name',
      'phone',
      'reference',
      'merchant_ref',
      'price',
      'quantity',
      'status',
      'method',
      'link',
      'review_code',
      'created_at',
      'updated_at'
   ];

   public function product()
   {
      return $this->belongsTo(Product::class, 'id_product');
   }

   public function user()
   {
      return $this->belongsTo(Category::class, 'id_user');
   }

   public function stock()
   {
      return $this->belongsTo(Stock::class, 'id_stock');
   }
    
}
