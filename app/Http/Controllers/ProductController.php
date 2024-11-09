<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();

        if ($request->has('search')) {
            $products->where('product_id', 'like', '%' . $request->search . '%')
                     ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort_by')) {
            $products->orderBy($request->sort_by, $request->sort_order ?? 'asc');
        }

        $products = $products->paginate(10);

        return view('products.index', compact('products'));
    }

    // ... other methods for create, store, show, edit, update, and delete
}