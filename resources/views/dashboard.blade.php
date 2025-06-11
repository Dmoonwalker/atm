<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <!-- Logo -->
            <div class="flex items-center">
                <span class="logo flex items-center text-xl font-bold">
                    <div class="w-8 h-8 bg-[#FFC403] rounded-full flex items-center justify-center mr-2 border-2 border-[#BB7614]">
                        <span class="text-[#BB7614] font-bold text-sm">✓</span>
                    </div>
                    ATM
                </span>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-[#FFC403] font-medium">Home</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Search</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Account</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Feedback</a>
                <div class="flex items-center space-x-2">
                    <span class="text-gray-600">♥</span>
                    <span class="text-gray-600">0</span>
                    <span class="text-gray-600">↗</span>
                </div>
            </nav>
        </div>
    </x-slot>

    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-600 mb-8">Discover amazing shops and products in your area</p>

            <!-- Action Cards -->
            <div class="grid md:grid-cols-3 gap-6 mb-12">
                <!-- Create Shop -->
                <div class="bg-white rounded-xl border border-gray-200 shadow p-6">
                    <div class="text-xl font-semibold mb-3 flex items-center">
                        <span class="mr-2 text-2xl">+</span> Create Shop
                    </div>
                    <p class="mb-6 text-gray-600">Start your own digital shop and reach more customers</p>
                    <x-create-shop-modal />
                </div>

                <!-- Browse Shops -->
                <div class="bg-white rounded-xl border border-gray-200 shadow p-6">
                    <div class="text-xl font-semibold mb-3 flex items-center">
                        <span class="mr-2 text-2xl">👁</span> Browse Shops
                    </div>
                    <p class="mb-6 text-gray-600">Explore local businesses and their products</p>
                    <a href="{{ route('shops.index') }}" class="w-full inline-block text-center px-4 py-2 border border-gray-300 text-[#222] font-semibold rounded-md hover:bg-gray-100 transition-colors">Browse All Shops</a>
                </div>

                <!-- My Favorites -->
                <div class="bg-white rounded-xl border border-gray-200 shadow p-6">
                    <div class="text-xl font-semibold mb-3 flex items-center">
                        <span class="mr-2 text-2xl">♥</span> My Favorites
                    </div>
                    <p class="mb-6 text-gray-600">View shops you've liked and supported</p>
                    <a href="#" class="w-full inline-block text-center px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-50 transition-colors">View Favorites</a>
                </div>
            </div>

            <!-- Featured Shops -->
            <h2 class="text-2xl font-bold mb-6">Featured Shops</h2>
            <div class="grid md:grid-cols-2 gap-6 mb-12">
                @forelse($featuredShops as $shop)
                <div class="bg-white rounded-xl border border-gray-200 shadow p-6">
                    <div class="flex items-start justify-between mb-2">
                        <div class="text-lg font-bold">{{ $shop->name }}</div>
                        <div class="flex items-center text-red-500">
                            <span class="mr-1">♥</span>
                            <span class="text-sm">{{ $shop->likes ?? 19 }}</span>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 mb-1">By {{ $shop->user->name ?? 'Unknown' }}</div>
                    <div class="text-sm text-gray-500 mb-1">
                        {{ $shop->categories ?? 'Snacks | Drinks' }}
                    </div>
                    <div class="text-sm text-gray-500 mb-3 flex items-center">
                        <span class="mr-1">📍</span> {{ $shop->address }}
                    </div>
                    <p class="text-gray-700 text-sm mb-4">{{ $shop->description ? Str::limit($shop->description, 100) : 'Fresh sandwiches made daily with premium ingredients. We\'re currently offering special...' }}</p>
                    <a href="#" class="w-full inline-block text-center px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-50 transition-colors">View Shop</a>
                </div>
                @empty
                <div class="col-span-2 text-center text-gray-500">No featured shops available.</div>
                @endforelse
            </div>

            <!-- My Shops -->
            <h2 class="text-2xl font-bold mb-6">My Shops</h2>
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($myShops as $shop)
                <div class="bg-white rounded-xl border-2 border-[#FFC403] shadow p-6">
                    <div class="flex items-start justify-between mb-2">
                        <div class="text-lg font-bold">{{ $shop->name }}</div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center text-red-500">
                                <span class="mr-1">♥</span>
                                <span class="text-sm">{{ $shop->likes ?? 19 }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <span class="mr-1">👁</span>
                                <span class="text-sm">{{ $shop->views ?? 200 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 mb-1">{{ $shop->categories ?? 'Snacks | Drinks' }}</div>
                    <div class="text-sm text-gray-500 mb-4 flex items-center">
                        <span class="mr-1">📍</span> {{ $shop->address }}
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('shops.show', $shop) }}" class="flex-1 inline-block text-center px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-50 transition-colors">View Shop</a>
                        <a href="{{ route('shops.manage', $shop) }}" class="flex-1 inline-block text-center px-4 py-2 bg-[#B8860B] text-white font-semibold rounded-md hover:bg-[#A0750A] transition-colors">Manage</a>
                    </div>
                </div>
                @empty
                <div class="col-span-2 text-center text-gray-500">You have not created any shops yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>