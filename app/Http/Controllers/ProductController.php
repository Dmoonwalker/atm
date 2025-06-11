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
        return view('products.index', compact('products', 'shop'));
    }

    public function create()
    {
        $shop = Auth::user()->shops->first();
        if (!$shop) {
            return redirect()->route('shops.index')
                ->with('error', 'You need to create a shop first.');
        }
        return view('products.create', compact('shop'));
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
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', // 2MB max
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $validated['shop_id'] = $shop->id;
        $validated['is_available'] = true;

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $shop = $product->shop;
        return view('products.edit', compact('product', 'shop'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
            'is_available' => 'boolean',
            'image' => 'nullable|image|max:2048', // 2MB max
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        \Log::info('Attempting to delete product: ' . $product->id);
        $this->authorize('delete', $product);
        $shop = $product->shop;
        $product->delete();
        \Log::info('Product deleted successfully');

        return redirect()->route('shops.manage', $shop)
            ->with('success', 'Product deleted successfully!');
    }
}
