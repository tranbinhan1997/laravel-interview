<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::orderBy('created_at', 'desc')->paginate(2);
        return view('pages.product.index', compact('categories', 'products'));
    }

    public function create(ProductRequest $request)
    {
        $data = $request->validated();

        if (Product::create([
            'category_id' => $data['category_id'],
            'product_name' => $data['product_name'],
            'unit' => $data['unit'],
            'price' => $data['price'],
        ])) {
            return redirect(route('products'))->with('success', 'Fruit item created successfully!');
        } 
        return redirect(route('products'))->with('error', 'Failed to create Fruit item. Please try again.');
    }
}
