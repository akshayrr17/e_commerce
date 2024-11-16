<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'image' => 'nullable|image',
        ]);


        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }


        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Product created successfully!',
        ]);
    }


    public function index(){

    $categories = Category::all();
    $products = Product::with('category')->get();

    return view('products.index', compact('categories', 'products'));
    }




public function edit($id)
{

    $product = Product::findOrFail($id);
    $categories = Category::all();

    return view('products.edit', compact('product', 'categories'));
}



public function update(Request $request, $id)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'image' => 'nullable|image',
    ]);


    $product = Product::findOrFail($id);


    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->category_id = $request->input('category_id');
    $product->description = $request->input('description');


    if ($request->hasFile('image')) {

        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }


        $imagePath = $request->file('image')->store('product_images', 'public');
        $product->image = $imagePath;
    }


    $product->save();

    if ($product) {
        return response()->json(['success' => true, 'message' => 'Product updated successfully.']);
    } else {
        return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.']);
    }

}



    public function delete($id)
{

    $product = Product::findOrFail($id);


    if ($product->image) {
        Storage::delete('public/' . $product->image);
    }


    $product->delete();


    return response()->json(['success' => true, 'message' => 'Product deleted successfully.']);
}

}
