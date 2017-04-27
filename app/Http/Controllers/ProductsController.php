<?php


namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
  public function index(){
     $products = DB::table('products')->get();
     return response()->json($products);
   }

  public function show($id){
     $product = Product::find($id);
     $product->stores = $product->stores;
     $product->reviews = $product->reviews;
     return response()->json($product);
   }

   public function post(Request $request){
     DB::table('products')->insert(
        [
          "title" => $request->input("title"),
          "brand" => $request->input("brand"),
          "price" => $request->input("price"),
          "description" => $request->input("description"),
          "image" => $request->input("image")
        ]
      );

      $products_id = DB::connection()->getPdo()->lastInsertId();
      foreach ($request->get("stores") as $store) {
          DB::table('product_store')->insert(
            [
              "product_id" => $products_id,
              "store_id" => $store
            ]
          );
      }

      return response()->json([
        "success" => true
      ]);
    }

    public function put(Request $request, $id){
      $product = Product::find($id);
      if ($request->get("title") !== NULL) {
        $product->title = $request->get("title");
      }
      if ($request->get("brand") !== NULL) {
        $product->price = $request->get("brand");
      }
      if ($request->get("price") !== NULL) {
        $product->title = $request->get("price");
      }
      if ($request->get("description") !== NULL) {
        $product->price = $request->get("description");
      }
      if ($request->get("image") !== NULL) {
        $product->price = $request->get("image");
      }
      $product->save();
      /*
      DB::table('products')
          ->where("id", $id)
          ->update([
            "title" => $request->input("title"),
            "price" => $request->input("price")
          ]);
          */
     }

     public function delete($id){
       DB::table('products')
           ->where("id", $id)
           ->delete();
      }
}
