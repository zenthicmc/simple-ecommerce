<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
   public function index()
   {
      $data = [
         'title' => 'Admin | Categories',
         'categories' => Category::all(),
      ];
      return view('dashboard.category', $data);
   }

   public function create()
   {
      $data = [
         'title' => 'Admin | Categories',
      ];
      return view('dashboard.category_new', $data);
   }

   public function create_store(Request $request)
   {
      $request->validate([
        'name' => ['required', 'string', 'max:255', 'unique:categories'],
        'description' => ['required', 'string', 'max:500'],
        'color' => ['required', 'string', 'max:255'],
      ]);

      Category::create([
        'name' => $request->name,
        'description' => $request->description,
        'color' => $request->color,
      ]);

      return redirect()->route('category')->with('success', 'Category created successfully');
   }

   public function edit($id)
   {
      $data = [
         'title' => 'Admin | Categories',
         'category' => Category::find($id),
      ];
      return view('dashboard.category_edit', $data);
   }

   public function edit_store($id, Request $request)
   {
      $category = Category::find($id);
      $request->name != $category->name ? $rules_name = $rules_name = ['required', 'string', 'max:255', 'unique:categories'] : $rules_name = ['required', 'string', 'max:255'];

      $request->validate([
        'name' => $rules_name,
        'description' => ['required', 'string', 'max:500'],
        'color' => ['required', 'string', 'max:255'],
      ]);


      $category->update([
        'name' => $request->name,
        'description' => $request->description,
        'color' => $request->color,
      ]);
      return redirect()->route('category')->with('success', 'Category updated successfully');
   }

   public function delete($id)
   {
      $category = Category::find($id);
      $category->delete();
      return redirect()->route('category')->with('success', 'Category deleted successfully');
   }
}
