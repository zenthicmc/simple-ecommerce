<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;


class ReviewController extends Controller
{
   public function index()
   {
      $data = [
         'title' => 'Admin | Reviews',
         'reviews' => Review::all(),
      ];
      return view('dashboard.review', $data);
   }

   public function create()
   {
      $data = [
         'title' => 'Admin | Reviews',
      ];
      return view('dashboard.review_new', $data);
   }

   public function create_store(Request $request)
   {
      $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'star' => ['required', 'string', 'max:5'],
        'description' => ['required', 'string', 'max:500'],
      ]);

      Review::create([
         'name' => $request->name,
         'star' => $request->star,
         'description' => $request->description,
      ]);

      return redirect()->route('review')->with('success', 'Review added successfully');
   }

   public function edit($id)
   {
      $data = [
         'title' => 'Admin | Reviews',
         'review' => Review::find($id),
      ];
      return view('dashboard.review_edit', $data);
   }

   public function edit_store($id, Request $request)
   {
      $review = Review::find($id);

      $request->validate([
         'name' => ['required', 'string', 'max:255'],
         'star' => ['required', 'string', 'max:5'],
         'description' => ['required', 'string', 'max:500'],
      ]);

      $review->update([
         'name' => $request->name,
         'star' => $request->star,
         'description' => $request->description,
      ]);

      return redirect()->route('review')->with('success', 'Review updated successfully');
   }

   public function delete($id)
   {
      $review = Review::find($id);
      $review->delete();
      return redirect()->route('review')->with('success', 'Review deleted successfully');
   }
}
