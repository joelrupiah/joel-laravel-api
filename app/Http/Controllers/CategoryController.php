<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required'
        ]);

        $slug = slugify($request->name);

        Category::create([
            'name' => $request->name,
            'slug' => $slug
        ]);

        return response()->json('Category created successfully', 200);
    }

    public function show(Category $category)
    {
        //
    }

    public function update(Request $request, Category $category, $id)
    {
        // return $request;
        $request->validate([
            'name' => 'required'
        ]);

        $category = Category::findOrFail($id);
        // return $category;
        $category->name = $request->name;
        $category->save();

        return response()->json('Category updated', 200);
    }

    public function destroy(Category $category, $id)
    {
        $category = Category::find($id, 'id');
        // return $category;
        $category->delete();

        return response()->json('Category deleted', 200);
    }
}
