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
                <a href="{{ route('shops.products.index', $shop) }}" class="text-emerald-600 hover:text-emerald-700 font-medium transition-colors">
                    {{ $shop->name }} Products
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-gray-700 font-semibold">Add Product</span>
            </nav>

            <!-- Success Message -->
            @if (session('status') === 'product-created')
            <div id="successMessage" class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-emerald-800">
                        Product created successfully!
                    </p>
                </div>
                <div class="ml-auto pl-3">
                    <button type="button" onclick="document.getElementById('successMessage').remove()" class="text-emerald-400 hover:text-emerald-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            @endif

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
                    <div class="flex items-center justify-between">
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
                        <div class="text-emerald-100 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Complete all fields to enable submit
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form action="{{ route('shops.products.store', $shop) }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="productForm">
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
                                        Product Name *
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                        placeholder="Enter product name" required>
                                    <div class="mt-1 text-xs text-gray-500">Minimum 3 characters required</div>
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <!-- Price -->
                                <div>
                                    <label for="price" class="block text-sm font-bold text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                        </svg>
                                        Price (₦) *
                                    </label>
                                    <input type="number" name="price" id="price" step="0.01" min="0.01" value="{{ old('price') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                        placeholder="0.00" required>
                                    <div class="mt-1 text-xs text-gray-500">Must be greater than ₦0.00</div>
                                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                </div>

                                <!-- Stock Quantity -->
                                <div>
                                    <label for="stock_quantity" class="block text-sm font-bold text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        Stock Quantity *
                                    </label>
                                    <input type="number" name="stock_quantity" id="stock_quantity" min="0" value="{{ old('stock_quantity') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                        placeholder="0" required>
                                    <div class="mt-1 text-xs text-gray-500">Must be 0 or greater</div>
                                    <x-input-error class="mt-2" :messages="$errors->get('stock_quantity')" />
                                </div>

                                <!-- Category -->
                                <div class="md:col-span-2">
                                    <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        Category *
                                    </label>
                                    <select name="category_id" id="category_id"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all" required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="mt-1 text-xs text-gray-500">Choose the most appropriate category</div>
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
                                    Description *
                                </label>
                                <textarea name="description" id="description" rows="5"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                    placeholder="Describe your product in detail..." required>{{ old('description') }}</textarea>
                                <div class="mt-2 flex items-center justify-between">
                                    <p class="text-sm text-gray-500">Provide a detailed description to help customers understand your product better.</p>
                                    <div class="text-xs text-gray-400">Minimum 10 characters</div>
                                </div>
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
                                    Upload Product Image *
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
                                            <input type="file" id="image" name="image_url" accept="image/*" class="hidden" onchange="previewImage(this)" required>
                                            <label for="image" class="cursor-pointer">
                                                <span class="inline-flex items-center px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition-colors">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                    Choose Image
                                                </span>
                                            </label>
                                        </div>
                                        <p class="text-sm text-gray-500">PNG, JPG, GIF up to 10MB (Required)</p>
                                    </div>
                                </div>

                                <!-- Image Preview -->
                                <div id="imagePreview" class="hidden">
                                    <div class="relative inline-block">
                                        <img id="previewImg" class="w-32 h-32 object-cover rounded-xl border-4 border-white shadow-lg" src="/placeholder.svg" alt="Preview">
                                        <button type="button" onclick="removeImage()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 transition-colors">
                                            ×
                                        </button>
                                    </div>
                                </div>

                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
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
                                    class="h-5 w-5 rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500" checked>
                                <label for="is_available" class="ml-3 text-sm font-medium text-gray-700">
                                    <span class="font-bold">Product is available for purchase</span>
                                    <div class="text-xs text-gray-500">Customers can see and purchase this product</div>
                                </label>
                            </div>
                        </div>

                        <!-- Validation Status -->
                        <div id="validationStatus" class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 hidden">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-yellow-800">Please complete the following:</p>
                                    <ul id="validationList" class="text-xs text-yellow-700 mt-1 list-disc list-inside"></ul>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4 pt-8 border-t border-gray-200">
                            <a href="{{ route('shops.products.index', $shop) }}" class="px-8 py-3 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-colors">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Go Back
                            </a>
                            <button type="submit" id="submitButton" disabled class="px-8 py-3 bg-gray-300 text-gray-500 font-semibold rounded-xl transition-all duration-300 cursor-not-allowed">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
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
                validateForm(); // Revalidate when image is selected
            }
        }

        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('previewImg').src = '';
            validateForm(); // Revalidate when image is removed
        }

        // Enhanced form validation
        const form = document.getElementById('productForm');
        const submitButton = document.getElementById('submitButton');
        const validationStatus = document.getElementById('validationStatus');
        const validationList = document.getElementById('validationList');

        function validateForm() {
            const validationErrors = [];
            let isValid = true;

            // Product name validation
            const name = document.getElementById('name').value.trim();
            if (!name) {
                validationErrors.push('Product name is required');
                isValid = false;
            } else if (name.length < 3) {
                validationErrors.push('Product name must be at least 3 characters');
                isValid = false;
            }

            // Price validation
            const price = parseFloat(document.getElementById('price').value);
            if (!price || price <= 0) {
                validationErrors.push('Price must be greater than ₦0.00');
                isValid = false;
            }

            // Stock quantity validation
            const stockQuantity = document.getElementById('stock_quantity').value;
            if (stockQuantity === '' || parseInt(stockQuantity) < 0) {
                validationErrors.push('Stock quantity must be 0 or greater');
                isValid = false;
            }

            // Category validation
            const categoryId = document.getElementById('category_id').value;
            if (!categoryId) {
                validationErrors.push('Category must be selected');
                isValid = false;
            }

            // Description validation
            const description = document.getElementById('description').value.trim();
            if (!description) {
                validationErrors.push('Description is required');
                isValid = false;
            } else if (description.length < 10) {
                validationErrors.push('Description must be at least 10 characters');
                isValid = false;
            }

            // Image validation
            const imageInput = document.getElementById('image');
            if (!imageInput.files || imageInput.files.length === 0) {
                validationErrors.push('Product image is required');
                isValid = false;
            }

            // Update validation status display
            if (validationErrors.length > 0) {
                validationStatus.classList.remove('hidden');
                validationList.innerHTML = validationErrors.map(error => `<li>${error}</li>`).join('');
            } else {
                validationStatus.classList.add('hidden');
            }

            // Update submit button state
            if (isValid) {
                submitButton.disabled = false;
                submitButton.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                submitButton.classList.add('bg-emerald-500', 'hover:bg-emerald-600', 'text-white', 'shadow-lg', 'hover:shadow-xl', 'transform', 'hover:scale-105');
                submitButton.innerHTML = `
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Create Product
                `;
            } else {
                submitButton.disabled = true;
                submitButton.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                submitButton.classList.remove('bg-emerald-500', 'hover:bg-emerald-600', 'text-white', 'shadow-lg', 'hover:shadow-xl', 'transform', 'hover:scale-105');
                submitButton.innerHTML = `
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Create Product
                `;
            }

            return isValid;
        }

        // Handle form submission with loading state
        form.addEventListener('submit', function(e) {
            if (!submitButton.disabled) {
                // Show loading state
                submitButton.disabled = true;
                submitButton.classList.remove('bg-emerald-500', 'hover:bg-emerald-600', 'hover:shadow-xl', 'transform', 'hover:scale-105');
                submitButton.classList.add('bg-emerald-400');
                submitButton.innerHTML = `
                    <svg class="animate-spin w-5 h-5 inline mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Creating Product...
                `;
            }
        });

        // Add event listeners to all form fields
        form.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('input', validateForm);
            field.addEventListener('change', validateForm);
            field.addEventListener('blur', validateForm);
        });

        // Add visual feedback for input focus
        form.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('focus', function() {
                this.classList.add('ring-2', 'ring-emerald-200');
            });

            field.addEventListener('blur', function() {
                this.classList.remove('ring-2', 'ring-emerald-200');
            });
        });

        // Initial validation
        validateForm();
    </script>
</x-app-layout>