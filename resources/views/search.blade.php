<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <nav class="mb-6 text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="hover:underline text-secondary">Home</a>
                <span>/</span>
                <span class="text-gray-700 font-semibold">Search</span>
            </nav>
            <h1 class="text-3xl font-bold mb-4 font-heading">Search Shops & Products</h1>

            <!-- Search Bar -->
            <form method="GET" action="" class="mb-6">
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">🔍</span>
                    <input type="text" name="search" placeholder="Search shops or products..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary bg-white"
                        value="{{ request('search') }}">
                </div>
            </form>

            <!-- Category Filters -->
            <div class="flex flex-wrap gap-3 mb-6">
                <a href="{{ route('search') }}"
                    class="px-4 py-2 rounded-lg font-medium {{ empty($selectedCategory) ? 'bg-secondary text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}">
                    All Categories
                </a>
                @foreach($categories as $category)
                <a href="{{ route('search', ['category' => $category->id]) }}"
                    class="px-4 py-2 rounded-lg font-medium {{ $selectedCategory == $category->id ? 'bg-secondary text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>

            <!-- Results Count -->
            <div class="mb-6 text-gray-600">Found {{ $shops->count() }} shops, {{ $products->count() }} products</div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Shops List -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 font-heading">Shops</h2>
                    <div class="space-y-6">
                        @forelse($shops as $shop)
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="text-lg font-bold text-gray-900">{{ $shop->name }}</h3>
                                        @if(!$shop->is_active)
                                        <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded">Inactive</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600">By {{ $shop->user->name ?? 'Unknown' }}</p>
                                </div>
                                <div class="flex items-center text-red-500">
                                    <span class="mr-1">♥</span>
                                    <span class="text-sm font-medium">{{ $shop->likes ?? rand(1,50) }}</span>
                                </div>
                            </div>
                            <div class="space-y-1 mb-3">
                                <div class="text-sm text-gray-500 flex items-center">
                                    <span class="mr-2">🍽️</span>
                                    <span>{{ $shop->category->name ?? 'N/A' }}</span>
                                </div>
                                <div class="text-sm text-gray-500 flex items-center">
                                    <span class="mr-2">📍</span>
                                    <span>{{ $shop->address }}, {{ $shop->local_government }}, {{ $shop->state }}</span>
                                </div>
                                <div class="text-sm text-gray-400">
                                    {{ $shop->opening_hours ?? '8:00 AM - 8:00 PM' }}
                                </div>
                            </div>
                            <p class="text-sm text-gray-700 mb-4 leading-relaxed">
                                {{ $shop->description ? Str::limit($shop->description, 120) : 'No description available.' }}
                            </p>
                            <div class="mb-4">
                                <div class="text-xs text-gray-500 mb-2">
                                    {{ $shop->products->count() }} product{{ $shop->products->count() == 1 ? '' : 's' }} available
                                </div>
                                <div class="flex gap-2">
                                    @foreach($shop->products->take(3) as $product)
                                    <div class="w-8 h-8 bg-gray-200 rounded"></div>
                                    @endforeach
                                    @if($shop->products->count() > 3)
                                    <div class="w-8 h-8 bg-gray-300 rounded flex items-center justify-center text-xs font-medium text-gray-600">
                                        +{{ $shop->products->count() - 3 }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @if(!$shop->is_active && $shop->likes < 5)
                                <div class="text-center text-sm text-gray-500 py-2">
                                Needs {{ 5 - $shop->likes }} more likes
                        </div>
                        @else
                        <a href="{{ route('shops.show', $shop) }}" class="w-full inline-block text-center px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-50 transition-colors">View Shop</a>
                        @endif
                    </div>
                    @empty
                    <div class="text-center text-gray-500 py-12">
                        No shops found.
                    </div>
                    @endforelse
                </div>
            </div>
            <!-- Products List -->
            <div>
                <h2 class="text-xl font-semibold mb-4 font-heading">Products</h2>
                <div class="space-y-6">
                    @forelse($products as $product)
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 flex items-center gap-4 cursor-pointer hover:shadow-lg transition"
                        onclick="window.dispatchEvent(new CustomEvent('show-product', { detail: { name: '{{ $product->name }}', price: '{{ $product->price }}', shop_name: '{{ $product->shop->name ?? '' }}', description: '{{ $product->description }}', shop_url: '{{ route('shops.show', $product->shop) }}' }}))">
                        <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <div class="font-semibold">{{ $product->name }}</div>
                                <div class="font-bold">₦{{ number_format($product->price, 0) }}</div>
                            </div>
                            <div class="text-xs text-gray-500 mb-1">
                                <a href="{{ route('shops.show', $product->shop) }}" class="hover:underline text-primary">{{ $product->shop->name ?? 'Unknown Shop' }}</a>
                            </div>
                            <div class="text-xs text-gray-500">{{ Str::limit($product->description, 60) }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 py-12">
                        No products found.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>