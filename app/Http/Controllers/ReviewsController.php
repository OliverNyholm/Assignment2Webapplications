<?php


namespace App\Http\Controllers;

use App\Review;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
  public function index(){
     $reviews = DB::table('reviews')->get();
     return response()->json($reviews);
   }

   public function show($id){
     $reviews = Review::find($id);
     $reviews->product = $reviews->product;
     return response()->json($reviews);
   }
}
