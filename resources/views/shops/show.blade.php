<x-app-layout>
    <div class="bg-[#FAFBFC] min-h-screen">
        <div class="max-w-3xl mx-auto py-10">
            <nav class="mb-6 text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="hover:underline text-[#BB7614]">Home</a>
                <span>/</span>
                <a href="{{ route('shops.index') }}" class="hover:underline text-[#BB7614]">Browse Shops</a>
                <span>/</span>
                <span class="text-gray-700 font-semibold">{{ $shop->name }}</span>
            </nav>
            <div class="bg-white rounded-xl shadow p-8 mb-8">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-6">
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center text-3xl text-gray-400">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-2xl font-bold mb-1">{{ $shop->name }}</div>
                            <div class="text-gray-700 text-sm mb-1">By {{ $shop->user->name ?? 'Unknown' }}</div>
                            <div class="text-gray-500 text-sm mb-1 flex items-center">
                                <span class="mr-2">&#127828;</span> {{ $shop->category->name ?? 'N/A' }}
                            </div>
                            <div class="text-gray-500 text-sm mb-1 flex items-center">
                                <span class="mr-2">&#128205;</span> {{ $shop->address }}, {{ $shop->local_government }}, {{ $shop->state }}
                            </div>
                            <div class="text-gray-500 text-sm mb-1 flex items-center">
                                <span class="mr-2">&#128340;</span> {{ $shop->opening_time->format('g:i A') }} - {{ $shop->closing_time->format('g:i A') }}
                            </div>
                            @if($shop->is_active)
                            <div class="text-green-500 text-sm flex items-center">
                                <span class="mr-2">&#10004;</span> Active Shop
                            </div>
                            @else
                            <div class="text-yellow-500 text-sm flex items-center">
                                <span class="mr-2">&#9888;</span> Needs {{ 5 - $shop->likes }} more likes to become active
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col items-end space-y-2">
                        <div class="flex items-center text-red-500 text-lg font-semibold">
                            <span class="mr-1">&#10084;</span> {{ $shop->likes }}
                        </div>
                    </div>
                </div>
                <div class="flex space-x-3 mt-6 mb-4">
                    @if(auth()->check() && auth()->user()->id === $shop->user_id)
                    <a href="{{ route('shops.manage', $shop) }}" class="px-4 py-2 bg-[#FFC403] text-[#BB7614] rounded-md font-semibold flex items-center hover:bg-[#FFD54F] transition-colors">
                        <span class="mr-2">&#9881;</span> Manage Shop
                    </a>
                    @endif
                    <button class="px-4 py-2 border rounded-md font-semibold flex items-center"><span class="mr-2">&#128257;</span> Share Business</button>
                    <button class="px-4 py-2 border rounded-md font-semibold flex items-center"><span class="mr-2">&#128190;</span> Download To Homescreen</button>
                </div>
                <div class="border-t pt-4 mt-4">
                    <div class="mb-2 font-semibold">Status:</div>
                    <div class="text-gray-700 text-sm">{{ $shop->description ?? 'No description available.' }}</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-8">
                <div class="mb-4 font-bold text-lg">Listing:</div>
                <div class="grid md:grid-cols-2 gap-6">
                    @forelse($shop->products as $product)
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center space-x-4 cursor-pointer hover:shadow-lg transition"
                        onclick="window.dispatchEvent(new CustomEvent('show-product', { detail: {
                            name: '{{ e($product->name) }}',
                            price: '{{ e($product->price) }}',
                            shop_name: '{{ e($shop->name) }}',
                            stock_quantity: '{{ $product->stock_quantity }}',
                            description: `{{ e($product->description) }}`
                        }}))">
                        <div class="w-16 h-16 rounded overflow-hidden">
                            @if(!empty($product->image_url))
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <div class="font-semibold">{{ $product->name }}</div>
                                <div class="font-bold">₦{{ number_format($product->price, 0) }}/Plate</div>
                            </div>
                            <div class="text-xs text-gray-500 mb-1">
                                <a href="{{ route('shops.show', $shop) }}" class="hover:underline text-primary">{{ $shop->name }}</a>
                            </div>
                            <div class="text-xs text-gray-500 mb-1">Taste: Spicy</div>
                            <div class="text-xs text-gray-500 mb-1">Size: Large</div>
                            <div class="text-xs text-gray-500">Topping: Chicken</div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 text-center text-gray-500">No products available.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>