<x-app-layout>
    <div class="bg-[#FAFBFC] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <!-- Navigation -->
            <nav class="mb-6 text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="hover:underline text-[#BB7614]">Home</a>
                <span>/</span>
                <a href="{{ route('shops.manage', $shop) }}" class="hover:underline text-[#BB7614]">Manage Shop</a>
                <span>/</span>
                <span class="text-gray-700 font-semibold">Add Product</span>
            </nav>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-xl font-bold mb-6">Add New Product</h2>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                        <x-input-error class="mt-2" :messages="$errors->get('stock_quantity')" />
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <input type="text" name="category" id="category" value="{{ old('category') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                        <x-input-error class="mt-2" :messages="$errors->get('category')" />
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
                        <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full">
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>

                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_available" value="1" class="rounded border-gray-300 text-[#FFC403] shadow-sm focus:ring-[#FFC403]" checked>
                            <span class="ml-2 text-sm text-gray-600">Product is available</span>
                        </label>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('shops.manage', $shop) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors mr-3">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-[#FFC403] text-[#BB7614] font-semibold rounded-md hover:bg-[#FFD54F] transition-colors">
                            Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>