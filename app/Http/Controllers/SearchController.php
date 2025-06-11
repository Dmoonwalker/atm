<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $selectedCategory = $request->input('category');

        $categories = Category::all();

        $shopsQuery = Shop::with(['user', 'category', 'products']);
        $productsQuery = Product::with(['shop']);

        if ($search) {
            $shopsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('local_government', 'like', "%{$search}%");
            });
            $productsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($selectedCategory) {
            $shopsQuery->where('category_id', $selectedCategory);
            $productsQuery->where('category_id', $selectedCategory);
        }

        $shops = $shopsQuery->get();
        $products = $productsQuery->get();

        return view('search', compact('shops', 'products', 'categories', 'selectedCategory'));
    }
}
