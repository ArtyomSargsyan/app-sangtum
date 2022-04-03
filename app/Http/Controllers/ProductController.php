<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
       public function index(){
           $products = Product::all();
           return response()->json(['products'=> $products], 200);
       }

        public function store(Request $request){
            $request->validate([
               'p_name'=> 'required|max:20 ',
               'p_description'=> 'required|max:30 ',
               'image'=> 'required|max:10 ',

            ]);
            $product = new Product;
            $product->p_name = $request->p_name;
            $product->p_description = $request->p_description;
            $product->image = $request->image;
            $product->save();
            return response()->json(['message'=> 'Product added successfully'], 200);

        }
        public function show($id){
           $products = Product::find($id);
           if ($products){
               return response()->json(['products'=>$products], 200);
           }else{
               return response()->json(['message'=> 'No record Found'], 400);
           }

        }
        public function update(Request $request, $id)
        {
            $request->validate([
                'p_name' => 'required|max:20 ',
                'p_description' => 'required|max:30 ',
                'image' => 'required|max:10 ',

            ]);
            $product = Product::find($id);
            if ($product) {
                $product->p_name = $request->p_name;
                $product->p_description = $request->p_description;
                $product->image = $request->image;
                $product->update();
                return response()->json(['message' => 'Product updated5 successfully'], 200);

            } else {
                return response()->json(['message' => 'Product not update'], 404);
            }
        }

        public function destroy($id){
           $product = Product::find($id);
           if($product){
               $product->delete();
               return response()->json(['message'=> 'Product Deleted Successfully'], 200);
           }else{
               return response()->json(['message'=> 'Product Not Deleted Error'], 404);
           }
        }
}
