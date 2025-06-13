<x-app-layout>
    <div class="bg-[#FAFBFC] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <!-- Navigation -->
            <nav class="mb-6 text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="hover:underline text-[#BB7614]">Home</a>
                <span>/</span>
                <a href="{{ route('shops.index') }}" class="hover:underline text-[#BB7614]">Shops</a>
                <span>/</span>
                <span class="text-gray-700 font-semibold">Manage {{ $shop->name }}</span>
                <span>/</span>
                <span class="text-gray-700 font-semibold" x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1)"></span>
            </nav>

            @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <!-- Shop Header -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $shop->name }}</h1>
                        <p class="text-gray-600 mt-1">{{ $shop->category->name }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="px-3 py-1 rounded-full text-sm {{ $shop->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $shop->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <a href="{{ route('shops.show', $shop) }}" target="_blank" class="text-[#BB7614] hover:text-[#8B5A2B]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            @if($shop->likes < 5)
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Low Likes Warning!</strong>
                <span class="block sm:inline"> Your shop has less than 5 likes. Get 5 likes to make your shop more visible to customers.</span>
        </div>
        @endif

        <!-- Tabs -->
        <div x-data="{ 
                activeTab: 'overview',
                showDeleteModal: false,
                productToDelete: null
            }" class="bg-white rounded-xl shadow-sm">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px">
                    <button @click="activeTab = 'overview'" :class="{ 'border-[#FFC403] text-[#BB7614]': activeTab === 'overview' }" class="px-6 py-4 text-sm font-medium border-b-2 border-transparent hover:text-[#BB7614]">
                        Overview
                    </button>
                    <button @click="activeTab = 'products'" :class="{ 'border-[#FFC403] text-[#BB7614]': activeTab === 'products' }" class="px-6 py-4 text-sm font-medium border-b-2 border-transparent hover:text-[#BB7614]">
                        Products
                    </button>
                    <button @click="activeTab = 'settings'" :class="{ 'border-[#FFC403] text-[#BB7614]': activeTab === 'settings' }" class="px-6 py-4 text-sm font-medium border-b-2 border-transparent hover:text-[#BB7614]">
                        Settings
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Overview Tab -->
                <div x-show="activeTab === 'overview'" class="space-y-6">
                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500">Total Products</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $shop->products->count() }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500">Active Products</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $shop->products->where('is_available', true)->count() }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500">Low Stock Items</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $shop->products->where('stock_quantity', '<', 10)->count() }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500">Total Likes</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $shop->likes }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500">Phone Number</div>
                            <div class="text-2xl font-bold text-gray-900">{{ $shop->phone }}</div>
                        </div>
                    </div>

                    <!-- Shop Details -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Shop Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <div class="text-sm text-gray-500">Address</div>
                                <div class="text-gray-900">{{ $shop->address }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Location</div>
                                <div class="text-gray-900">{{ $shop->local_government }}, {{ $shop->state }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Phone</div>
                                <div class="text-gray-900">{{ $shop->phone }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Email</div>
                                <div class="text-gray-900">{{ $shop->email ?? 'Not provided' }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Operating Hours</div>
                                <div class="text-gray-900">{{ $shop->opening_time }} - {{ $shop->closing_time }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Tab -->
                <div x-show="activeTab === 'products'" class="space-y-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Products</h3>
                        <a href="{{ route('products.create') }}" class="px-4 py-2 bg-[#FFC403] text-[#BB7614] font-semibold rounded-md hover:bg-[#FFD54F] transition-colors">
                            Add Product
                        </a>
                    </div>

                    <!-- Products Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($shop->products as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                @if(!empty($product->image_url))
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                                @else
                                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                                <div class="text-sm text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ₦{{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $product->stock_quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->is_available ? 'Available' : 'Unavailable' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-3">
                                            <a href="{{ route('products.edit', $product) }}" class="text-[#BB7614] hover:text-[#A0750A]">Edit</a>
                                            <button onclick="confirmDelete('{{ $product->id }}')" class="text-red-600 hover:text-red-900">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No products found. <a href="{{ route('products.create') }}" class="text-[#BB7614] hover:underline">Add your first product</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Settings Tab -->
                <div x-show="activeTab === 'settings'" class="space-y-6">
                    <form method="POST" action="{{ route('shops.update', $shop) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Shop Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Shop Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $shop->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]">{{ old('description', $shop->description) }}</textarea>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $shop->address) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $shop->phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $shop->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]">
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-[#FFC403] shadow-sm focus:ring-[#FFC403]" {{ old('is_active', $shop->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">Active</span>
                            </label>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('shops.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors mr-3">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-[#FFC403] text-[#BB7614] font-semibold rounded-md hover:bg-[#FFD54F] transition-colors">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Simple Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-xl max-w-sm mx-4">
            <h3 class="text-lg font-semibold mb-4">Delete Product</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this product? This action cannot be undone.</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#FFC403] text-[#BB7614] font-semibold rounded-md hover:bg-[#FFD54F]">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function confirmDelete(productId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `/products/${productId}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</x-app-layout>