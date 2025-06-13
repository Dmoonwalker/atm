@props(['shops'])

<div x-data="{ 
    show: false,
    loading: false,
    error: null,
    success: null,
    shopId: null,
    
    async importProducts() {
        if (!this.shopId) {
            this.error = 'Please select a shop';
            return;
        }

        this.loading = true;
        this.error = null;
        this.success = null;

        try {
            const response = await fetch('{{ route('whatsapp.import') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    shop_id: this.shopId
                })
            });
            const data = await response.json();
            
            if (data.success) {
                this.success = 'Products imported successfully!';
                setTimeout(() => {
                    this.show = false;
                    this.reset();
                }, 2000);
            } else {
                this.error = data.error;
            }
        } catch (err) {
            this.error = 'Failed to import products';
        }
        this.loading = false;
    },
    
    reset() {
        this.shopId = null;
        this.error = null;
        this.success = null;
        this.loading = false;
    }
}"
    x-show="show"
    x-on:open-modal.window="show = true"
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

        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Import Products from WhatsApp
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

                        <!-- Success Message -->
                        <div x-show="success"
                            x-transition
                            class="mb-4 p-4 bg-green-50 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800" x-text="success"></p>
                                </div>
                            </div>
                        </div>

                        <!-- Loading State -->
                        <div x-show="loading"
                            x-transition
                            class="flex items-center justify-center py-4">
                            <svg class="animate-spin h-8 w-8 text-[#FFC403]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="ml-3 text-sm text-gray-600">Importing products...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button"
                    @click="importProducts()"
                    :disabled="loading"
                    class="inline-flex items-center px-4 py-2 bg-[#FFC403] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#E6B000] focus:bg-[#E6B000] active:bg-[#E6B000] focus:outline-none focus:ring-2 focus:ring-[#FFC403] focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50">
                    Import Products
                </button>
                <button type="button"
                    @click="show = false"
                    :disabled="loading"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#FFC403] focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>