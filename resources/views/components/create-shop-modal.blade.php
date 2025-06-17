<div x-data="{ 
    open: false,
    loading: false,
    success: false,
    selectedState: '',
    selectedLGA: '',
    formValid: false,
    states: {{ json_encode(json_decode(file_get_contents(public_path('data/states.json')))) }},
    
    validateForm() {
        const form = this.$refs.shopForm;
        const requiredFields = [
            form.querySelector('#name'),
            form.querySelector('#address'),
            form.querySelector('#state'),
            form.querySelector('#local_government'),
            form.querySelector('#opening_time'),
            form.querySelector('#closing_time')
        ];
        
        let isValid = true;
        
        // Check if all required fields have values
        requiredFields.forEach(field => {
            if (!field || !field.value.trim()) {
                isValid = false;
            }
        });
        
        // Additional validation for opening/closing times
        const openingTime = form.querySelector('#opening_time').value;
        const closingTime = form.querySelector('#closing_time').value;
        
        if (openingTime && closingTime && openingTime >= closingTime) {
            isValid = false;
        }
        
        this.formValid = isValid;
    },
    
    async submitForm(event) {
        if (!this.formValid) return;
        
        this.loading = true;
        const form = event.target;
        const formData = new FormData(form);
        
        // Log form data before submission
        console.log('Form data being submitted:', {
            name: formData.get('name'),
            description: formData.get('description'),
            address: formData.get('address'),
            state: formData.get('state'),
            local_government: formData.get('local_government'),
            opening_time: formData.get('opening_time'),
            closing_time: formData.get('closing_time'),
            category_id: formData.get('category_id')
        });
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                }
            });
            
            // Log the response
            console.log('Response status:', response.status);
            const responseData = await response.json().catch(() => null);
            console.log('Response data:', responseData);
            
            if (response.ok) {
                this.success = true;
                setTimeout(() => {
                    this.success = false;
                    this.open = false;
                    window.location.reload();
                }, 2000);
            } else {
                // Log error response
                console.error('Error response:', responseData);
                alert('Failed to create shop. Please try again.');
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            alert('An error occurred while creating the shop. Please try again.');
        } finally {
            this.loading = false;
        }
    }
}" x-init="$watch('selectedState', () => { selectedLGA = ''; validateForm(); })">
    <button @click="open = true" type="button" class="w-full inline-block text-center px-4 py-2 bg-[#FFC403] text-[#BB7614] font-semibold rounded-md hover:bg-[#FFD54F] transition-colors">Create New Shop</button>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40" style="display: none;">
        <div @click.away="open = false" class="bg-white rounded-xl shadow-lg p-8 w-full max-w-lg relative">
            <button @click="open = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl leading-none">&times;</button>

            <!-- Success Message -->
            <div x-show="success" class="absolute inset-0 bg-white rounded-xl flex items-center justify-center" style="display: none;">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Shop Created Successfully!</h3>
                    <p class="text-gray-600">Redirecting...</p>
                </div>
            </div>

            <!-- Loading Spinner -->
            <div x-show="loading" class="absolute inset-0 bg-white bg-opacity-75 rounded-xl flex items-center justify-center" style="display: none;">
                <div class="text-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-4 border-[#FFC403] border-t-transparent mx-auto mb-4"></div>
                    <p class="text-gray-600">Creating your shop...</p>
                </div>
            </div>

            <!-- Modal Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Create New Shop</h2>
                <p class="text-gray-600 text-sm">Fill in all required fields to create your shop</p>
            </div>

            <!-- Form -->
            <form @submit.prevent="submitForm" method="POST" action="{{ route('shops.store') }}" class="space-y-4" x-ref="shopForm">
                @csrf

                <!-- Shop Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Shop Name *
                    </label>
                    <input id="name" name="name" type="text"
                        @input="validateForm()"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] transition-colors"
                        placeholder="Enter shop name"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Choose a unique name for your shop</p>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="3"
                        @input="validateForm()"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] transition-colors"
                        placeholder="Describe your shop (optional)"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Brief description of your shop</p>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                        Address *
                    </label>
                    <input id="address" name="address" type="text"
                        @input="validateForm()"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] transition-colors"
                        placeholder="Enter shop address"
                        required>
                    <p class="text-xs text-gray-500 mt-1">Full address of your shop location</p>
                </div>

                <!-- State and LGA -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-1">
                            State *
                        </label>
                        <select id="state" name="state"
                            x-model="selectedState"
                            @change="validateForm()"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] transition-colors"
                            required>
                            <option value="">Select State</option>
                            <template x-for="state in states" :key="state.alias">
                                <option :value="state.state" x-text="state.state"></option>
                            </template>
                        </select>
                    </div>
                    <div>
                        <label for="local_government" class="block text-sm font-medium text-gray-700 mb-1">
                            Local Government *
                        </label>
                        <select id="local_government" name="local_government"
                            x-model="selectedLGA"
                            @change="validateForm()"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] transition-colors"
                            required>
                            <option value="">Select LGA</option>
                            <template x-for="lga in selectedState ? states.find(s => s.state === selectedState)?.lgas : []" :key="lga">
                                <option :value="lga" x-text="lga"></option>
                            </template>
                        </select>
                    </div>
                </div>

                <!-- Opening and Closing Times -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="opening_time" class="block text-sm font-medium text-gray-700 mb-1">
                            Opening Time *
                        </label>
                        <input id="opening_time" name="opening_time" type="time"
                            @change="validateForm()"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] transition-colors"
                            required>
                    </div>
                    <div>
                        <label for="closing_time" class="block text-sm font-medium text-gray-700 mb-1">
                            Closing Time *
                        </label>
                        <input id="closing_time" name="closing_time" type="time"
                            @change="validateForm()"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] transition-colors"
                            required>
                    </div>
                </div>

                <!-- Time Validation Message -->
                <div x-show="$refs.shopForm?.querySelector('#opening_time')?.value && $refs.shopForm?.querySelector('#closing_time')?.value && $refs.shopForm?.querySelector('#opening_time')?.value >= $refs.shopForm?.querySelector('#closing_time')?.value"
                    class="bg-red-50 border border-red-200 rounded-md p-3 text-sm text-red-700"
                    style="display: none;">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Opening time must be before closing time
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Category
                    </label>
                    <select id="category_id" name="category_id"
                        @change="validateForm()"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] transition-colors">
                        <option value="">Select Category (Optional)</option>
                        @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Choose a category that best describes your shop</p>
                </div>

                <!-- Validation Status -->
                <div x-show="!formValid && ($refs.shopForm?.querySelector('#name')?.value || $refs.shopForm?.querySelector('#address')?.value)"
                    class="bg-yellow-50 border border-yellow-200 rounded-md p-3 text-sm text-yellow-700"
                    style="display: none;">
                    <div class="flex items-start">
                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="font-medium">Please complete all required fields:</p>
                            <ul class="mt-1 list-disc list-inside text-xs space-y-1">
                                <li x-show="!$refs.shopForm?.querySelector('#name')?.value?.trim()">Shop name is required</li>
                                <li x-show="!$refs.shopForm?.querySelector('#address')?.value?.trim()">Address is required</li>
                                <li x-show="!selectedState">State must be selected</li>
                                <li x-show="!selectedLGA">Local Government must be selected</li>
                                <li x-show="!$refs.shopForm?.querySelector('#opening_time')?.value">Opening time is required</li>
                                <li x-show="!$refs.shopForm?.querySelector('#closing_time')?.value">Closing time is required</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-4 mt-8 pt-4 border-t border-gray-200">

                    <button type="submit"
                        :disabled="!formValid || loading"
                        :class="formValid && !loading ? 
                                'bg-[#FFC403] text-[#BB7614] hover:bg-[#FFD54F] shadow-md hover:shadow-lg transform hover:scale-105' : 
                                'bg-gray-300 text-gray-500 cursor-not-allowed'"
                        class="px-6 py-2 font-semibold rounded-md transition-all duration-200">
                        <span x-show="!loading">
                            <svg x-show="formValid" class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create Shop
                        </span>
                        <span x-show="loading" class="flex items-center">
                            <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Creating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>