<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Product Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] rounded-md shadow-sm" required>{{ old('description', $product->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="old('price', $product->price)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <div>
                            <x-input-label for="stock_quantity" :value="__('Stock Quantity')" />
                            <x-text-input id="stock_quantity" name="stock_quantity" type="number" class="mt-1 block w-full" :value="old('stock_quantity', $product->stock_quantity)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('stock_quantity')" />
                        </div>

                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] rounded-md shadow-sm" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <div>
                            <x-input-label for="image" :value="__('Product Image')" />
                            @if($product->image_path)
                            <div class="mt-2">
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="h-32 w-32 object-cover rounded-lg">
                            </div>
                            @endif
                            <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>

                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_available" value="1" class="rounded border-gray-300 text-[#FFC403] shadow-sm focus:ring-[#FFC403]" {{ old('is_available', $product->is_available) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Product is available') }}</span>
                            </label>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('shops.manage', $product->shop) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors mr-3">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-[#FFC403] text-[#BB7614] font-semibold rounded-md hover:bg-[#FFD54F] transition-colors">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>