<x-app-layout>
    <div class="bg-gradient-to-br from-emerald-50 to-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto py-10 px-4">
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
                <a href="{{ route('shops.index') }}" class="text-emerald-600 hover:text-emerald-700 font-medium transition-colors">Browse Shops</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-gray-700 font-semibold">{{ $shop->name }}</span>
            </nav>

            <!-- Shop Header Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-emerald-100 overflow-hidden mb-8">
                <!-- Shop Header Background -->
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-6">
                            <!-- Shop Avatar -->
                            <div class="w-24 h-24 rounded-full bg-white bg-opacity-20 border-4 border-white shadow-lg flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0v-3.28a1 1 0 01.684-.948l1.923-.641a1 1 0 00.632-.928c0-.513.492-.926 1.1-.926h4.522c.608 0 1.1.413 1.1.926 0 .408.21.783.632.928l1.923.641a1 1 0 01.684.948V21" />
                                </svg>
                            </div>

                            <!-- Shop Info -->
                            <div class="text-white">
                                <h1 class="text-3xl font-bold mb-2">{{ $shop->name }}</h1>
                                <div class="flex items-center text-emerald-100 mb-2">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    By {{ $shop->user->name ?? 'Unknown' }}
                                </div>

                                <!-- Status Badge -->
                                @if($shop->is_active)
                                <div class="inline-flex items-center bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Active Shop
                                </div>
                                @else
                                <div class="inline-flex items-center bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    Needs {{ 5 - $shop->likes_count }} more likes
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Like Button -->
                        @php
                        $isLiked = auth()->check() ? $shop->likedBy(auth()->user()) : false;
                        @endphp
                        <div class="flex flex-col items-center bg-white bg-opacity-20 rounded-xl p-4">
                            <button
                                x-data="{
                                    liked: {{ $isLiked ? 'true' : 'false' }},
                                    likesCount: {{ $shop->likes_count }},
                                    async toggleLike() {
                                        const response = await fetch('{{ route('shops.like.toggle', $shop) }}', {
                                            method: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                'Accept': 'application/json'
                                            }
                                        });
                                        const data = await response.json();
                                        this.liked = data.is_liked;
                                        this.likesCount = data.likes_count;
                                    }
                                }"
                                :class="liked ? 'text-red-300' : 'text-white'"
                                @click="toggleLike"
                                class="focus:outline-none hover:scale-110 transition-transform mb-2"
                                title="Like this shop"
                                type="button">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            </button>
                            <span x-text="likesCount" class="text-white font-bold text-lg"></span>
                            <span class="text-emerald-100 text-xs">likes</span>
                        </div>
                    </div>
                </div>

                <!-- Shop Details -->
                <div class="p-8">
                    <div class="grid md:grid-cols-3 gap-6 mb-6">
                        <!-- Category -->
                        <div class="flex items-center p-4 bg-emerald-50 rounded-xl">
                            <div class="p-2 bg-emerald-100 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Category</div>
                                <div class="font-semibold text-gray-900">{{ $shop->category->name ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-center p-4 bg-blue-50 rounded-xl">
                            <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Location</div>
                                <div class="font-semibold text-gray-900 text-sm">{{ $shop->local_government }}, {{ $shop->state }}</div>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="flex items-center p-4 bg-purple-50 rounded-xl">
                            <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Hours</div>
                                <div class="font-semibold text-gray-900 text-sm">{{ $shop->opening_time->format('g:i A') }} - {{ $shop->closing_time->format('g:i A') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-semibold text-gray-900">Full Address</span>
                        </div>
                        <p class="text-gray-700">{{ $shop->address }}, {{ $shop->local_government }}, {{ $shop->state }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 mb-6">
                        @if(auth()->check() && auth()->user()->id === $shop->user_id)
                        <a href="{{ route('shops.manage', $shop) }}" class="inline-flex items-center px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-semibold transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Manage Shop
                        </a>
                        @endif

                        <button class="inline-flex items-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-semibold transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                            </svg>
                            Share Business
                        </button>

                        <button class="inline-flex items-center px-6 py-3 bg-purple-500 hover:bg-purple-600 text-white rounded-xl font-semibold transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Add to Home
                        </button>
                    </div>

                    <!-- Description -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex items-center mb-3">
                            <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="font-bold text-lg text-gray-900">About This Shop</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed">{{ $shop->description ?? 'No description available.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="bg-white rounded-2xl shadow-xl border border-emerald-100 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-white">Products</h2>
                        <span class="text-purple-100">{{ $shop->products->count() }} items</span>
                    </div>
                </div>

                <div class="p-8">
                    @if($shop->products->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($shop->products as $product)
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="aspect-w-16 aspect-h-9 bg-gray-100">
                                @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="object-cover w-full h-full">
                                @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-1">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->description, 100) }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-emerald-600">₦{{ number_format($product->price, 2) }}</span>
                                    <span class="text-sm text-gray-500">{{ $product->stock_quantity }} in stock</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Products Yet</h3>
                        <p class="text-gray-600">This shop hasn't added any products yet.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>