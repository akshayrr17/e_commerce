<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;

class HomeController extends Controller
{
    public function index(){

        $products = product::with('category')->get();
        $categories = category::get();
        // dd($products);
        // dd($categories);
        return view('home', compact('products','categories'));

    }
}
