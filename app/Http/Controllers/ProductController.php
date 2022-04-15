<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * show all products
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(["products" => $products], 200);
    }

    /**
     * Add product data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|max:20 ",
            "description" => "required|max:30 ",
            "image" => "required",
        ]);
        $product = new Product();
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $allowedfileExtention = ["pdf", "jpg", "png"];
            $extention = $file->getClientOriginalExtension();
            $check = in_array($extention, $allowedfileExtention);
            if ($check) {
                $name = time() . $file->GetClientOriginalName();
                $file->move("images", $name);
                $product->image = $name;
            }
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();
        return response()->json(
            ["message" => "Product added successfully"],
            200
        );
    }

    /**
     * Show product
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $products = Product::find($id);
        if ($products) {
            return response()->json(["products" => $products], 200);
        } else {
            return response()->json(["message" => "No record Found"], 400);
        }
    }

    /**
     * Update products
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|max:20 ",
            "description" => "required|max:30 ",
            "image" => "required",
        ]);
        $product = Product::find($id);
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $allowedfileExtention = ["pdf", "jpg", "png"];
            $extention = $file->getClientOriginalExtension();
            $check = in_array($extention, $allowedfileExtention);
            if ($check) {
                $name = time() . $file->getClientOriginalName();
                $file->move("images", $name);
                $product->image = $name;
            }
        }
        if ($product) {
            $product->name = $request->name;
            $product->description = $request->description;
            $product->image = $request->image;
            $product->update();
            return response()->json(
                ["message" => "Product updated successfully"],
                200
            );
        } else {
            return response()->json(["message" => "Product not update"], 404);
        }
    }

    /**
     * Update products
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * delete products
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(
                ["message" => "Product Deleted Successfully"],
                200
            );
        } else {
            return response()->json(
                ["message" => "Product Not Deleted Error"],
                404
            );
        }
    }
}
