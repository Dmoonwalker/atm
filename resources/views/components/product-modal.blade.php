<div
    x-data="{ open: false, product: null }"
    x-on:show-product.window="product = $event.detail; open = true"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    @click.self="open = false">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 relative border-t-8 border-primary">
        <button class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl" @click="open = false">&times;</button>
        <template x-if="product">
            <div>
                <h2 class="text-2xl font-bold mb-4 text-primary" x-text="product.name"></h2>
                <div class="mb-3 flex items-center">
                    <span class="font-semibold text-gray-500 mr-2">Price:</span>
                    <span class="text-lg font-bold text-secondary" x-text="'₦' + product.price"></span>
                </div>
                <div class="mb-3 flex items-center">
                    <span class="font-semibold text-gray-500 mr-2">Shop:</span>
                    <span class="text-gray-700" x-text="product.shop_name"></span>
                </div>
                <div class="mb-4">
                    <span class="font-semibold text-gray-500 block mb-1">Description:</span>
                    <span class="text-gray-700" x-text="product.description"></span>
                </div>
                <template x-if="product.shop_url">
                    <a :href="product.shop_url" class="inline-block px-4 py-2 bg-primary text-secondary font-semibold rounded-md hover:bg-accent transition-colors mt-2">Visit Shop</a>
                </template>
            </div>
        </template>
    </div>
</div>