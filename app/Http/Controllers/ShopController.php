<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Category;

class ShopController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function create()
    {
        $categories = Category::all();
        $states = json_decode(file_get_contents(public_path('data/states.json')), true);

        // Create a simple array of states for the dropdown
        $stateList = collect($states)->pluck('state')->toArray();

        // Create a map of states to their LGAs
        $stateLgas = collect($states)->mapWithKeys(function ($state) {
            return [$state['state'] => $state['lgas']];
        })->toArray();

        return view('shops.create', compact('categories', 'stateList', 'stateLgas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'category_id' => 'required|exists:categories,id',
            'state' => 'required|string|max:255',
            'local_government' => 'required|string|max:255',
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
        ]);

        $shop = Shop::create($validated);

        return response()->json(['message' => 'Shop created successfully'], 200);
    }

    public function edit(Shop $shop)
    {
        $this->authorize('update', $shop);
        return view('shops.edit', compact('shop'));
    }

    public function update(Request $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'is_active' => 'boolean',
        ]);

        $shop->update($validated);

        return redirect()->route('dashboard')->with('success', 'Shop updated successfully!');
    }

    public function qr(Shop $shop)
    {
        $this->authorize('view', $shop);
        return view('shops.qr', compact('shop'));
    }

    public function analytics(Shop $shop)
    {
        $this->authorize('view', $shop);

        $stats = [
            'total_products' => $shop->products()->count(),
            'active_products' => $shop->products()->where('is_available', true)->count(),
            'low_stock_products' => $shop->products()->where('stock_quantity', '<', 10)->count(),
            'total_value' => $shop->products()->sum('price'),
        ];

        return view('shops.analytics', compact('shop', 'stats'));
    }

    public function index(Request $request)
    {
        $query = Shop::with(['category', 'user', 'products']);

        // Filter by category if selected
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('local_government', 'like', "%{$search}%");
            });
        }

        $shops = $query->get();
        $categories = Category::all();
        $selectedCategory = $request->category;

        return view('shops.index', compact('shops', 'categories', 'selectedCategory'));
    }

    public function show(Shop $shop)
    {
        $shop->load(['user', 'category', 'products']);
        return view('shops.show', compact('shop'));
    }

    public function manage(Shop $shop)
    {
        $this->authorize('update', $shop);
        $shop->load(['category', 'products']);
        return view('shops.manage', compact('shop'));
    }
}
