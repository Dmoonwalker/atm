<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $shop = Auth::user()->shops->first();
        $products = $shop ? $shop->products()->paginate(10) : collect();

        // Debug log for products and their images
        Log::info('Products in index:', [
            'products' => $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image_url' => $product->image_url,
                    'has_image' => !empty($product->image_url)
                ];
            })->toArray()
        ]);

        return view('products.index', compact('products', 'shop'));
    }

    public function create()
    {
        $shop = Auth::user()->shops->first();
        if (!$shop) {
            return redirect()->route('shops.index')
                ->with('error', 'You need to create a shop first.');
        }
        $categories = \App\Models\Category::all();
        return view('products.create', compact('shop', 'categories'));
    }

    public function store(Request $request)
    {
        $shop = Auth::user()->shops->first();
        if (!$shop) {
            return redirect()->route('shops.index')
                ->with('error', 'You need to create a shop first.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // 2MB max
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $validated['shop_id'] = $shop->id;
        $validated['is_available'] = $request->has('is_available');

        try {
            Product::create($validated);
            return redirect()->route('shops.manage', $shop)
                ->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to add product. Please try again.');
        }
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $shop = $product->shop;
        $categories = \App\Models\Category::all();
        return view('products.edit', compact('product', 'shop', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_available' => 'boolean',
            'image' => 'nullable|image|max:2048', // 2MB max
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $validated['is_available'] = $request->has('is_available');

        try {
            $product->update($validated);
            return redirect()->route('shops.manage', $product->shop)
                ->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to update product. Please try again.');
        }
    }

    public function destroy(Product $product)
    {
        Log::info('Attempting to delete product: ' . $product->id);
        $this->authorize('delete', $product);
        $shop = $product->shop;
        $product->delete();
        Log::info('Product deleted successfully');

        return redirect()->route('shops.manage', $shop)
            ->with('success', 'Product deleted successfully!');
    }
}
