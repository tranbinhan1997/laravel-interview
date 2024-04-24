<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(2);
        return view('pages.category.index', compact('categories'));
    }

    public function create(CategoryRequest $request)
    {
        $data = $request->validated();

        if (Category::create([
            'category_name' => $data['category_name'],
        ])) {
            return redirect(route('categories'))->with('success', 'Category created successfully!');
        } 
        return redirect(route('categories'))->with('error', 'Failed to create category. Please try again.');
    }
}
