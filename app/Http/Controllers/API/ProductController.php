<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class  ProductController extends Controller
{
    /**
     * show all products
     *
     * @return JsonResponse
     */
    public function index()
    {
        $products = Product::all();
        return response()->json(["products" => $products], 200);
    }


    /**
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $path = Storage::putFile('public', $request->file('image'));
        $date = $request->validated();

        Product::create([
            'name' => $date['name'],
            'description' => $date['description'],
            'price' => $date['price'],
            'image' => $path
        ]);

        $url = DB::table('products')->latest()->first();
        $img = Storage::url($url->image);

        return response()->json(['success' => 'product created successfully', $img, $url->name, $url->price, $url->description]);
    }


    /**
     * Show product
     *
     * @return JsonResponse
     */
    public function show()
    {
        return User::where('id', '=', 5)->get();
    }

    /**
     * Update products
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
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
     *
     * @param $id
     * @return JsonResponse
     * delete products
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(
                ["message" => "Product Deleted Successfully"]
            );
        } else {
            return response()->json(
                ["message" => "Product Not Deleted Error"],
                404
            );
        }
    }
}
