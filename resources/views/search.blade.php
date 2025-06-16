<x-app-layout>
    <div class="bg-gradient-to-br from-emerald-50 to-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <!-- Breadcrumb Navigation -->
            <nav class="mb-8 flex items-center space-x-2 text-sm">
                <a href="{{ route('dashboard') }}" class="text-emerald-600 hover:text-emerald-700 font-medium transition-colors">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Home
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-gray-700 font-semibold">Search</span>
            </nav>

            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="p-3 bg-emerald-100 rounded-xl">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold text-emerald-900">Search Shops & Products</h1>
                </div>
                <p class="text-gray-600">Discover amazing local businesses and products in your area</p>
            </div>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('search') }}" class="mb-8">
                <div class="relative max-w-2xl">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" placeholder="Search shops or products..."
                        class="w-full pl-12 pr-4 py-4 border border-emerald-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-white shadow-lg text-lg"
                        value="{{ request('search') }}">
                    <button type="submit" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                        <div class="bg-emerald-500 hover:bg-emerald-600 text-white p-2 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </button>
                </div>
            </form>

            <!-- Category Filters -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Categories
                </h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('search') }}"
                        class="px-6 py-3 rounded-xl font-medium transition-all {{ empty($selectedCategory) ? 'bg-emerald-500 text-white shadow-lg' : 'bg-white border border-gray-300 text-gray-700 hover:bg-emerald-50 hover:border-emerald-300' }}">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        All Categories
                    </a>
                    @foreach($categories as $category)
                    <a href="{{ route('search', ['category' => $category->id]) }}"
                        class="px-6 py-3 rounded-xl font-medium transition-all {{ $selectedCategory == $category->id ? 'bg-emerald-500 text-white shadow-lg' : 'bg-white border border-gray-300 text-gray-700 hover:bg-emerald-50 hover:border-emerald-300' }}">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Results Count -->
            <div class="mb-8 p-4 bg-white rounded-xl border border-emerald-100 shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-medium">Found {{ $shops->count() }} shops, {{ $products->count() }} products</span>
                    </div>
                    @if(request('search'))
                    <div class="text-sm text-gray-500">
                        Searching for: <span class="font-medium text-emerald-600">"{{ request('search') }}"</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Shops List -->
                <div>
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-blue-100 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0v-3.28a1 1 0 01.684-.948l1.923-.641a1 1 0 00.632-.928c0-.513.492-.926 1.1-.926h4.522c.608 0 1.1.413 1.1.926 0 .408.21.783.632.928l1.923.641a1 1 0 01.684.948V21" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Shops</h2>
                        <span class="ml-3 px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">{{ $shops->count() }}</span>
                    </div>

                    <div class="space-y-6">
                        @forelse($shops as $shop)
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                            <!-- Shop Header -->
                            <div class="p-6 border-b border-gray-100">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <h3 class="text-xl font-bold text-gray-900">{{ $shop->name }}</h3>
                                            @if(!$shop->is_active)
                                            <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full font-medium">Inactive</span>
                                            @else
                                            <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-full font-medium">Active</span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            By {{ $shop->user->name ?? 'Unknown' }}
                                        </p>
                                    </div>
                                    <div class="flex items-center bg-red-50 px-3 py-2 rounded-lg">
                                        <svg class="w-4 h-4 text-red-500 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                        </svg>
                                        <span class="text-sm font-medium text-red-600">{{ $shop->likes_count }}</span>
                                    </div>
                                </div>

                                <!-- Shop Details -->
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        <span>{{ $shop->category->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span>{{ $shop->address }}, {{ $shop->local_government }}, {{ $shop->state }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>{{ $shop->opening_time->format('g:i A') }} - {{ $shop->closing_time->format('g:i A') }}</span>
                                    </div>
                                </div>

                                <p class="text-sm text-gray-700 leading-relaxed">
                                    {{ $shop->description ? Str::limit($shop->description, 120) : 'No description available.' }}
                                </p>
                            </div>

                            <!-- Products Preview -->
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm text-gray-600 font-medium">
                                        {{ $shop->products->count() }} product{{ $shop->products->count() == 1 ? '' : 's' }} available
                                    </div>
                                </div>

                                @if($shop->products->count() > 0)
                                <div class="flex gap-2 mb-4">
                                    @foreach($shop->products->take(4) as $product)
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden border-2 border-white shadow-sm">
                                        @if($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-100 to-emerald-200">
                                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                    @if($shop->products->count() > 4)
                                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center text-xs font-bold text-emerald-700 border-2 border-white shadow-sm">
                                        +{{ $shop->products->count() - 4 }}
                                    </div>
                                    @endif
                                </div>
                                @endif

                                <!-- Action Button -->
                                @if(!$shop->is_active && $shop->likes_count < 5)
                                    <div class="text-center">
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-3">
                                        <p class="text-sm text-yellow-800 font-medium">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Needs {{ 5 - $shop->likes_count }} more likes to activate
                                        </p>
                                    </div>
                            </div>
                            @else
                            <a href="{{ route('shops.show', $shop) }}"
                                class="w-full inline-flex items-center justify-center px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View Shop
                            </a>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0v-3.28a1 1 0 01.684-.948l1.923-.641a1 1 0 00.632-.928c0-.513.492-.926 1.1-.926h4.522c.608 0 1.1.413 1.1.926 0 .408.21.783.632.928l1.923.641a1 1 0 01.684.948V21" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No shops found</h3>
                        <p class="text-gray-500">Try adjusting your search criteria</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Products List -->
            <div>
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-purple-100 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Products</h2>
                    <span class="ml-3 px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">{{ $products->count() }}</span>
                </div>

                <div class="space-y-4">
                    @forelse($products as $product)
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-lg hover:shadow-xl transition-all duration-300 p-6 cursor-pointer product-card"
                        data-product='{"name":"{{ addslashes($product->name) }}","price":"{{ $product->price }}","shop_name":"{{ addslashes($product->shop->name ?? '') }}","description":"{{ addslashes($product->description) }}","shop_url":"{{ route('shops.show', $product->shop) }}"}'>
                        <div class="flex items-center gap-4">
                            <!-- Product Image -->
                            <div class="w-20 h-20 bg-gray-200 rounded-xl overflow-hidden flex-shrink-0 border-2 border-gray-100">
                                @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @elseif($product->image_path)
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-100 to-purple-200">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-lg text-gray-900 truncate">{{ $product->name }}</h3>
                                    <div class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-lg font-bold text-lg ml-4">
                                        ₦{{ number_format($product->price, 0) }}
                                    </div>
                                </div>

                                <div class="flex items-center text-sm text-gray-600 mb-2">
                                    <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0v-3.28a1 1 0 01.684-.948l1.923-.641a1 1 0 00.632-.928c0-.513.492-.926 1.1-.926h4.522c.608 0 1.1.413 1.1.926 0 .408.21.783.632.928l1.923.641a1 1 0 01.684.948V21" />
                                    </svg>
                                    <a href="{{ route('shops.show', $product->shop) }}" class="hover:text-emerald-600 font-medium transition-colors">
                                        {{ $product->shop->name ?? 'Unknown Shop' }}
                                    </a>
                                </div>

                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ Str::limit($product->description, 80) }}
                                </p>
                            </div>

                            <!-- Action Arrow -->
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
                        <p class="text-gray-500">Try adjusting your search criteria</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Products:', JSON.parse('{{ json_encode($products) }}'));
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', function() {
                const productData = JSON.parse(this.dataset.product);
                window.dispatchEvent(new CustomEvent('show-product', {
                    detail: productData
                }));
            });
        });
    });
</script>