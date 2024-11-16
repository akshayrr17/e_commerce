<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function create()
    {

        $categories = Category::whereNull('parent_id')->get();
        // dd($categories);
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::create($request->all());

        if ($category) {
            return response()->json(['success' => true, 'message' => 'Category created successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.']);
        }
    }

    public function index()
    {

        $categories = Category::with('children')->get();
        // dd($categories);
        return view('categories.index', compact('categories'));
    }

    public function edit($id)
    {

        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->get();
        return view('categories.edit', compact('category', 'categories')); // Pa
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->save();

        if ($category) {
            return response()->json(['success' => true, 'message' => 'Category updated successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong. Please try again.']);
        }
    }

    public function delete($id)
    {

        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully!',
        ]);
    }
}
