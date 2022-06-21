<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{


    public function index(Request $request)
    {
       $userId = Auth::id();

       $product = new Product();
       $product->name  = $request->name;
       $product->description = $request->description;
       $product->price =  $request->price;
       $product->userId = $userId;
       $product->save();



       return response()->json(['success'=> 'product created successful']);
    }


}