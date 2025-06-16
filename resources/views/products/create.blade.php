<x-app-layout>
    <div class="bg-gradient-to-br from-emerald-50 to-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 py-10">
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
                <a href="{{ route('shops.manage', $shop) }}" class="text-emerald-600 hover:text-emerald-700 font-medium transition-colors">Manage Shop</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-gray-700 font-semibold">Add Product</span>
            </nav>

            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-3">
                    <div class="p-3 bg-emerald-100 rounded-xl">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-emerald-900">Add New Product</h1>
                        <p class="text-gray-600 mt-1">Create a new product for your shop inventory</p>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-emerald-100 overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-white bg-opacity-20 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div class="text-white">
                            <h2 class="text-2xl font-bold">Product Information</h2>
                            <p class="text-emerald-100">Fill in the details for your new product</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8"
                        x-data="{ 
                            isDirty: false,
                            originalValues: {
                                name: '',
                                description: '',
                                price: '',
                                stock_quantity: '',
                                category_id: '',
                                is_available: false
                            },
                            checkDirty() {
                                this.isDirty = 
                                    this.$refs.name.value !== this.originalValues.name ||
                                    this.$refs.description.value !== this.originalValues.description ||
                                    this.$refs.price.value !== this.originalValues.price ||
                                    this.$refs.stock_quantity.value !== this.originalValues.stock_quantity ||
                                    this.$refs.category_id.value !== this.originalValues.category_id ||
                                    this.$refs.is_available.checked !== this.originalValues.is_available ||
                                    this.$refs.image.files.length > 0;
                            }
                        }"
                        @input="checkDirty">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
                            <div class="flex items-center mb-6">
                                <div class="p-2 bg-blue-500 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Basic Information</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Product Name -->
                                <div class="md:col-span-2">
                                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        Product Name
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                        placeholder="Enter product name" required x-ref="name">
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <!-- Price -->
                                <div>
                                    <label for="price" class="block text-sm font-bold text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                        </svg>
                                        Price (₦)
                                    </label>
                                    <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                        placeholder="0.00" required x-ref="price">
                                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                </div>

                                <!-- Stock Quantity -->
                                <div>
                                    <label for="stock_quantity" class="block text-sm font-bold text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        Stock Quantity
                                    </label>
                                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                        placeholder="0" required x-ref="stock_quantity">
                                    <x-input-error class="mt-2" :messages="$errors->get('stock_quantity')" />
                                </div>

                                <!-- Category -->
                                <div class="md:col-span-2">
                                    <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        Category
                                    </label>
                                    <select name="category_id" id="category_id"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all" required x-ref="category_id">
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200">
                            <div class="flex items-center mb-6">
                                <div class="p-2 bg-purple-500 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Product Description</h3>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">
                                    Description
                                </label>
                                <textarea name="description" id="description" rows="5"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                    placeholder="Describe your product in detail..." required x-ref="description">{{ old('description') }}</textarea>
                                <p class="text-sm text-gray-500 mt-2">Provide a detailed description to help customers understand your product better.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>

                        <!-- Image Upload Section -->
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-6 border border-orange-200">
                            <div class="flex items-center mb-6">
                                <div class="p-2 bg-orange-500 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Product Image</h3>
                            </div>

                            <div class="space-y-4">
                                <label for="image" class="block text-sm font-bold text-gray-700">
                                    Upload Product Image
                                </label>

                                <!-- File Upload Area -->
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-emerald-400 transition-colors">
                                    <div class="space-y-4">
                                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                        </div>
                                        <div>
                                            <input type="file" id="image" name="image_url" accept="image/*" class="hidden" onchange="previewImage(this)" x-ref="image">
                                            <label for="image" class="cursor-pointer">
                                                <span class="inline-flex items-center px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition-colors">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    Choose Image
                                                </span>
                                            </label>
                                        </div>
                                        <p class="text-sm text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>

                                <!-- Image Preview -->
                                <div id="imagePreview" class="hidden">
                                    <div class="relative inline-block">
                                        <img id="previewImg" class="w-32 h-32 object-cover rounded-xl border-4 border-white shadow-lg" src="/placeholder.svg" alt="Preview">
                                        <button type="button" onclick="removeImage()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Availability Section -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
                            <div class="flex items-center mb-6">
                                <div class="p-2 bg-green-500 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Product Availability</h3>
                            </div>

                            <div class="flex items-center p-4 bg-white rounded-xl border border-green-200">
                                <input type="checkbox" name="is_available" value="1" id="is_available"
                                    class="h-5 w-5 rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" checked x-ref="is_available">
                                <label for="is_available" class="ml-3 text-sm font-medium text-gray-700">
                                    <span class="font-bold">Product is available for purchase</span>
                                    <div class="text-xs text-gray-500">Customers can see and purchase this product</div>
                                </label>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-8 border-t border-gray-200">
                            <a href="{{ route('shops.manage', $shop) }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                                Cancel
                            </a>
                            <button type="submit"
                                x-bind:disabled="!isDirty"
                                class="px-6 py-3 bg-emerald-500 text-white font-semibold rounded-xl transition-colors"
                                :class="!isDirty ? 'opacity-50 cursor-not-allowed' : 'hover:bg-emerald-600'">
                                Create Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('previewImg').src = '';
        }
    </script>
</x-app-layout>