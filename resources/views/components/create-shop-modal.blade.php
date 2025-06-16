<div x-data="{ 
    open: false,
    loading: false,
    success: false,
    selectedState: '',
    selectedLGA: '',
    isDirty: false,
    originalValues: {
        name: '',
        description: '',
        category_id: '',
        address: '',
        state: '',
        local_government: '',
        opening_time: '',
        closing_time: '',
        phone: ''
    },
    states: {{ json_encode(json_decode(file_get_contents(public_path('data/states.json')))) }},
    checkDirty() {
        this.isDirty = 
            this.$refs.name.value !== this.originalValues.name ||
            this.$refs.description.value !== this.originalValues.description ||
            this.$refs.category_id.value !== this.originalValues.category_id ||
            this.$refs.address.value !== this.originalValues.address ||
            this.$refs.state.value !== this.originalValues.state ||
            this.$refs.local_government.value !== this.originalValues.local_government ||
            this.$refs.opening_time.value !== this.originalValues.opening_time ||
            this.$refs.closing_time.value !== this.originalValues.closing_time ||
            this.$refs.phone.value !== this.originalValues.phone;
    },
    async submitForm(event) {
        this.loading = true;
        const form = event.target;
        const formData = new FormData(form);
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                }
            });
            
            if (response.ok) {
                this.success = true;
                setTimeout(() => {
                    this.success = false;
                    this.open = false;
                    window.location.reload();
                }, 2000);
            }
        } catch (error) {
            console.error('Error:', error);
        } finally {
            this.loading = false;
        }
    }
}">
    <!-- Trigger Button -->
    <button @click="open = true" type="button"
        class="w-full inline-flex items-center justify-center px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition-colors shadow-lg">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Create New Shop
    </button>

    <!-- Modal -->
    <div x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        style="display: none;">

        <div @click.away="open = false"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl mx-4 relative">

            <!-- Close Button -->
            <button @click="open = false"
                class="absolute top-4 right-4 z-10 text-gray-400 hover:text-gray-600 p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Success Overlay -->
            <div x-show="success"
                class="absolute inset-0 bg-white rounded-2xl flex items-center justify-center z-20"
                style="display: none;">
                <div class="text-center">
                    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-emerald-900 mb-2">Shop Created Successfully!</h3>
                    <p class="text-emerald-600">Your shop is ready for business.</p>
                </div>
            </div>

            <!-- Loading Overlay -->
            <div x-show="loading"
                class="absolute inset-0 bg-white bg-opacity-90 rounded-2xl flex items-center justify-center z-20"
                style="display: none;">
                <div class="text-center">
                    <div class="animate-spin rounded-full h-16 w-16 border-4 border-emerald-500 border-t-transparent mb-4"></div>
                    <p class="text-emerald-600 font-medium">Creating your shop...</p>
                </div>
            </div>

            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-6 rounded-t-2xl">
                <div class="flex items-center">
                    <div class="p-2 bg-white bg-opacity-20 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0v-3.28a1 1 0 01.684-.948l1.923-.641a1 1 0 00.632-.928c0-.513.492-.926 1.1-.926h4.522c.608 0 1.1.413 1.1.926 0 .408.21.783.632.928l1.923.641a1 1 0 01.684.948V21" />
                        </svg>
                    </div>
                    <div class="text-white">
                        <h2 class="text-2xl font-bold">Create New Shop</h2>
                        <p class="text-emerald-100">Set up your business profile</p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-8">
                <form @submit.prevent="submitForm" method="POST" action="{{ route('shops.store') }}" @input="checkDirty">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Shop Name -->
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Shop Name</label>
                                <input id="name" name="name" type="text" x-ref="name"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
                                    placeholder="Enter your shop name" required>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                                <textarea id="description" name="description" rows="3" x-ref="description"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
                                    placeholder="Describe your shop"></textarea>
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                                <select id="category_id" name="category_id" x-ref="category_id"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required>
                                    <option value="">Select a category</option>
                                    @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-bold text-gray-700 mb-2">Address</label>
                                <input id="address" name="address" type="text" x-ref="address"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
                                    placeholder="Enter your shop address" required>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- State -->
                            <div>
                                <label for="state" class="block text-sm font-bold text-gray-700 mb-2">State</label>
                                <select id="state" name="state" x-model="selectedState" x-ref="state"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required>
                                    <option value="">Select State</option>
                                    <template x-for="state in states" :key="state.alias">
                                        <option :value="state.state" x-text="state.state"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- Local Government -->
                            <div>
                                <label for="local_government" class="block text-sm font-bold text-gray-700 mb-2">Local Government</label>
                                <select id="local_government" name="local_government" x-model="selectedLGA" x-ref="local_government"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required>
                                    <option value="">Select LGA</option>
                                    <template x-for="lga in selectedState ? states.find(s => s.state === selectedState)?.lgas : []" :key="lga">
                                        <option :value="lga" x-text="lga"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- Operating Hours -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="opening_time" class="block text-sm font-bold text-gray-700 mb-2">Opening Time</label>
                                    <input id="opening_time" name="opening_time" type="time" x-ref="opening_time"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required>
                                </div>
                                <div>
                                    <label for="closing_time" class="block text-sm font-bold text-gray-700 mb-2">Closing Time</label>
                                    <input id="closing_time" name="closing_time" type="time" x-ref="closing_time"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200" required>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                                <input id="phone" name="phone" type="tel" x-ref="phone"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200"
                                    placeholder="Enter phone number" required>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" @click="open = false"
                            class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            x-bind:disabled="!isDirty"
                            class="px-6 py-3 bg-emerald-500 text-white font-semibold rounded-xl transition-colors"
                            :class="!isDirty ? 'opacity-50 cursor-not-allowed' : 'hover:bg-emerald-600'">
                            Create Shop
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>