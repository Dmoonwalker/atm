@props(['shops'])

<div x-data="{ 
    show: false,
    step: 1,
    loading: false,
    error: null,
    products: [],
    selectedProducts: [],
    importResults: null,
    shopId: null,
    
    async fetchProducts() {
        this.loading = true;
        this.error = null;
        try {
            const response = await fetch('{{ route('whatsapp.products') }}');
            const data = await response.json();
            if (data.success) {
                this.products = data.products;
            } else {
                this.error = data.error;
            }
        } catch (err) {
            this.error = 'Failed to fetch products';
        }
        this.loading = false;
    },
    
    async importSelected() {
        this.loading = true;
        this.error = null;
        try {
            const response = await fetch('{{ route('whatsapp.import') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    selected_products: this.selectedProducts,
                    shop_id: this.shopId
                })
            });
            const data = await response.json();
            if (data.success) {
                this.importResults = data;
                this.step = 3;
            } else {
                this.error = data.error;
            }
        } catch (err) {
            this.error = 'Failed to import products';
        }
        this.loading = false;
    },
    
    nextStep() {
        if (this.step === 1 && this.selectedProducts.length === 0) {
            this.error = 'Please select at least one product';
            return;
        }
        if (this.step === 1 && !this.shopId) {
            this.error = 'Please select a shop';
            return;
        }
        this.step++;
        if (this.step === 2) {
            this.importSelected();
        }
    },
    
    reset() {
        this.step = 1;
        this.products = [];
        this.selectedProducts = [];
        this.importResults = null;
        this.error = null;
    }
}"
    x-show="show"
    x-on:open-modal.window="show = true; fetchProducts()"
    x-on:close-modal.window="show = false; reset()"
    x-on:keydown.escape.window="show = false"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    x-cloak>

    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <!-- Step 1: Product Selection -->
            <div x-show="step === 1">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Select Products to Import
                            </h3>

                            <!-- Shop Selection -->
                            <div class="mb-4">
                                <label for="shop_id" class="block text-sm font-medium text-gray-700">Select Shop</label>
                                <select x-model="shopId" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] rounded-md shadow-sm">
                                    <option value="">Select a shop</option>
                                    @foreach($shops as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Error Message -->
                            <div x-show="error"
                                x-transition
                                class="mb-4 p-4 bg-red-50 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-red-800" x-text="error"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Loading State -->
                            <div x-show="loading"
                                x-transition
                                class="flex items-center justify-center py-8">
                                <svg class="animate-spin h-8 w-8 text-[#FFC403]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>

                            <!-- Product Grid -->
                            <div x-show="!loading" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                <template x-for="product in products" :key="product.id">
                                    <div class="border rounded-lg p-4 hover:border-[#FFC403] transition-colors">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-shrink-0">
                                                <input type="checkbox"
                                                    :value="product.id"
                                                    x-model="selectedProducts"
                                                    class="h-4 w-4 text-[#FFC403] focus:ring-[#FFC403] border-gray-300 rounded">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <img :src="product.image_url"
                                                    :alt="product.name"
                                                    class="w-full h-32 object-cover rounded-lg mb-2">
                                                <p class="text-sm font-medium text-gray-900" x-text="product.name"></p>
                                                <p class="text-sm text-gray-500" x-text="'₦' + product.price"></p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        @click="nextStep()"
                        class="inline-flex items-center px-4 py-2 bg-[#FFC403] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#E6B000] focus:bg-[#E6B000] active:bg-[#E6B000] focus:outline-none focus:ring-2 focus:ring-[#FFC403] focus:ring-offset-2 transition ease-in-out duration-150">
                        Next
                    </button>
                    <button type="button"
                        @click="show = false"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#FFC403] focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>

            <!-- Step 2: Importing -->
            <div x-show="step === 2">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Importing Products
                            </h3>

                            <div class="flex items-center justify-center py-8">
                                <svg class="animate-spin h-8 w-8 text-[#FFC403]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="ml-3 text-sm text-gray-600">Importing selected products...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Results -->
            <div x-show="step === 3">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Import Results
                            </h3>

                            <!-- Success Message -->
                            <div x-show="importResults"
                                x-transition
                                class="mb-4 p-4 bg-green-50 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">
                                            Successfully imported <span x-text="importResults.imported_count"></span> products
                                            <span x-show="importResults.errors.length > 0" x-text="' (with ' + importResults.errors.length + ' errors)'"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Error List -->
                            <div x-show="importResults.errors.length > 0"
                                x-transition
                                class="mt-4">
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Failed Imports:</h4>
                                <ul class="space-y-2">
                                    <template x-for="error in importResults.errors" :key="error.product">
                                        <li class="text-sm text-red-600">
                                            <span x-text="error.product"></span>: <span x-text="error.error"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        @click="show = false"
                        class="inline-flex items-center px-4 py-2 bg-[#FFC403] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#E6B000] focus:bg-[#E6B000] active:bg-[#E6B000] focus:outline-none focus:ring-2 focus:ring-[#FFC403] focus:ring-offset-2 transition ease-in-out duration-150">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>