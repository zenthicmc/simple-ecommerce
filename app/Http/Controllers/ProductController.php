<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 

class ProductController extends Controller
{
   public function index()
   {
      $data = [
         'title' => 'Admin | Products',
         'products' => Product::all()->sortBy('id_category'),
      ];
      return view('dashboard.product', $data);
   }

   public function create()
   {
      $data = [
         'title' => 'Admin | Products',
         'categories' => Category::all(),
      ];
      return view('dashboard.product_new', $data);
   }

   public function create_store(Request $request)
   {
      $request->image ? $rules_image = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000' : $rules_image = 'nullable';

      $request->validate([
		  'id_category' => ['required', 'integer'],
        'name' => ['required', 'string', 'max:255', 'unique:products'],
        'description' => ['required', 'string', 'max:100000'],
        'price' => ['required', 'numeric'],
		  'image' => $rules_image,
      ]);

      if($request->image) {
         $image_name = time().'.'.$request->image->getClientOriginalExtension();
         $request->image->move(public_path('product-images/'), $image_name);
      }
      else {
         $image_name = 'product.jpg';
      }

      Product::create([
         'id_category' => $request->id_category,
         'name' => $request->name,
         'slug' => Str::slug($request->name),
         'description' => $request->description,
         'price' => $request->price,
         'image' => $image_name,
		]);

      return redirect()->route('product')->with('success', 'Product created successfully');
   }

   public function edit($id)
   {
      $data = [
         'title' => 'Admin | Products',
         'product' => Product::find($id),
         'categories' => Category::all(),
      ];
      return view('dashboard.product_edit', $data);
   }

   public function edit_store($id, Request $request)
   {
      $product = Product::find($id);
      $request->name != $product->name ? $rules_name = $rules_name = ['required', 'string', 'max:255', 'unique:products'] : $rules_name = ['required', 'string', 'max:255'];
      $request->image ? $rules_image = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000' : $rules_image = 'nullable';

      $request->validate([
         'id_category' => ['required', 'integer'],
         'name' => $rules_name,
         'description' => ['required', 'string', 'max:100000'],
         'price' => ['required', 'numeric'],
         'image' => $rules_image,
      ]);

      if($request->image) {
         $image_name = time().'.'.$request->image->getClientOriginalExtension();
         $request->image->move(public_path('product-images/'), $image_name);
      }
      else {
         $image_name = $product->image;
      }

      $product->update([
			'id_category' => $request->id_category,
			'name' => $request->name,
         'slug' => Str::slug($request->name),
			'description' => $request->description,
			'price' => $request->price,
			'image' => $image_name,
		]);

      return redirect()->route('product')->with('success', 'Product updated successfully');
   }

   public function delete($id)
   {
      $product = Product::find($id);
      // delete image
      File::delete(public_path('product-images/'.$product->image));
      $product->delete();
      return redirect()->route('product')->with('success', 'Product deleted successfully');
   }
}
