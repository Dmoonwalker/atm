<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index(Shop $shop)
    {
        $products = $shop->products()->with('category')->paginate(10);
        return view('products.index', compact('products', 'shop'));
    }

    public function create(Shop $shop)
    {
        $categories = Category::all();
        return view('products.create', compact('categories', 'shop'));
    }

    public function store(Request $request, Shop $shop)
    {
        Log::info('Starting product creation process', [
            'shop_id' => $shop->id,
            'request_data' => $request->except(['image_url']), // Log all request data except the image
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0.01',
            'stock_quantity' => 'required|integer|min:0',
            'is_available' => 'boolean',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
            'category_id' => 'required|exists:categories,id',
        ]);

        Log::info('Validation passed', [
            'validated_data' => $validated
        ]);

        try {
            // Handle image upload
            if ($request->hasFile('image_url')) {
                Log::info('Processing image upload', [
                    'original_name' => $request->file('image_url')->getClientOriginalName(),
                    'mime_type' => $request->file('image_url')->getMimeType(),
                    'size' => $request->file('image_url')->getSize()
                ]);

                $imagePath = $request->file('image_url')->store('products', 'public');
                $validated['image_url'] = Storage::url($imagePath);

                Log::info('Image uploaded successfully', [
                    'image_path' => $imagePath,
                    'image_url' => $validated['image_url']
                ]);
            } else {
                Log::warning('No image file provided in request');
            }

            Log::info('Creating product record', [
                'shop_id' => $shop->id,
                'product_data' => $validated
            ]);

            $product = $shop->products()->create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'stock_quantity' => $validated['stock_quantity'],
                'is_available' => $request->boolean('is_available', true),
                'image_url' => $validated['image_url'],
                'category_id' => $validated['category_id']
            ]);

            Log::info('Product created successfully', [
                'product_id' => $product->id,
                'shop_id' => $shop->id,
                'product_data' => $product->toArray()
            ]);

            return redirect()->route('shops.manage', $shop)
                ->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create product', [
                'error' => $e->getMessage(),
                'error_trace' => $e->getTraceAsString(),
                'shop_id' => $shop->id,
                'request_data' => $request->except(['image_url']),
                'validated_data' => $validated ?? null
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    public function show(Shop $shop, Product $product)
    {
        return view('products.show', compact('shop', 'product'));
    }

    public function edit(Shop $shop, Product $product)
    {
        // Get all categories if user doesn't have any
        $categories = $shop->user->categories()->exists()
            ? $shop->user->categories
            : Category::all();

        return view('products.edit', compact('shop', 'product', 'categories'));
    }

    public function update(Request $request, Shop $shop, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'is_available' => 'boolean',
            'image_url' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $product->update($validated);

            Log::info('Product updated successfully', [
                'product_id' => $product->id,
                'shop_id' => $shop->id,
                'user_id' => $shop->user_id
            ]);

            return redirect()->route('shops.manage', $shop)
                ->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update product', [
                'error' => $e->getMessage(),
                'product_id' => $product->id,
                'shop_id' => $shop->id,
                'user_id' => $shop->user_id
            ]);

            return back()->with('error', 'Failed to update product. Please try again.');
        }
    }

    public function destroy(Shop $shop, Product $product)
    {
        try {
            $product->delete();

            Log::info('Product deleted successfully', [
                'product_id' => $product->id,
                'shop_id' => $shop->id,
                'user_id' => $shop->user_id
            ]);

            return redirect()->route('shops.manage', $shop)
                ->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete product', [
                'error' => $e->getMessage(),
                'product_id' => $product->id,
                'shop_id' => $shop->id,
                'user_id' => $shop->user_id
            ]);

            return back()->with('error', 'Failed to delete product. Please try again.');
        }
    }
}
