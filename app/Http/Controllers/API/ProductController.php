<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Jobs\CreateProductJob;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Add product data
     *
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $userId = Auth::id();
        CreateProductJob::dispatch($request->name ,$request->description,$request->price,$userId);
        return response()->json(['message'=>'send message job wait for reply'],201);

    }

    /**
     * Show product
     *
     * @param $id
     * @return JsonResponse
     */
    public function show()
    {
        return User::where('id','=',5)->get();
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
