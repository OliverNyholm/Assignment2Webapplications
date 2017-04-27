<?php


namespace App\Http\Controllers;

use App\Store;
use Illuminate\Support\Facades\DB;

class StoresController extends Controller
{
  public function index(){
     $stores = DB::table('stores')->get();
     return response()->json($stores);
   }

   public function show($id){
     $stores = Store::find($id);
     $stores->products = $stores->products;
     return response()->json($stores);
   }

   public function post(Request $request){
     DB::table('stores')->insert(
        [
          "title" => $request->input("title"),
          "city" => $request->input("city")
        ]
      );
    }
}
