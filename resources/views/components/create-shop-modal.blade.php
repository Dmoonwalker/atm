<div x-data="{ 
    open: false,
    loading: false,
    success: false,
    selectedState: '',
    selectedLGA: '',
    states: {{ json_encode(json_decode(file_get_contents(public_path('data/states.json')))) }},
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
    <button @click="open = true" type="button" class="w-full inline-block text-center px-4 py-2 bg-[#FFC403] text-[#BB7614] font-semibold rounded-md hover:bg-[#FFD54F] transition-colors">Create New Shop</button>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40" style="display: none;">
        <div @click.away="open = false" class="bg-white rounded-xl shadow-lg p-8 w-full max-w-lg relative">
            <button @click="open = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">&times;</button>

            <!-- Success Message -->
            <div x-show="success" class="absolute inset-0 bg-white rounded-xl flex items-center justify-center" style="display: none;">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Shop Created Successfully!</h3>
                </div>
            </div>

            <!-- Loading Spinner -->
            <div x-show="loading" class="absolute inset-0 bg-white bg-opacity-75 rounded-xl flex items-center justify-center" style="display: none;">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-[#FFC403] border-t-transparent"></div>
            </div>

            <h2 class="text-xl font-bold mb-4">Create Shop</h2>
            <form @submit.prevent="submitForm" method="POST" action="{{ route('shops.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Shop Name</label>
                    <input id="name" name="name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]"></textarea>
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input id="address" name="address" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                        <select id="state" name="state" x-model="selectedState" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                            <option value="">Select State</option>
                            <template x-for="state in states" :key="state.alias">
                                <option :value="state.state" x-text="state.state"></option>
                            </template>
                        </select>
                    </div>
                    <div>
                        <label for="local_government" class="block text-sm font-medium text-gray-700">Local Government</label>
                        <select id="local_government" name="local_government" x-model="selectedLGA" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                            <option value="">Select LGA</option>
                            <template x-for="lga in selectedState ? states.find(s => s.state === selectedState)?.lgas : []" :key="lga">
                                <option :value="lga" x-text="lga"></option>
                            </template>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="opening_time" class="block text-sm font-medium text-gray-700">Opening Time</label>
                        <input id="opening_time" name="opening_time" type="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                    </div>
                    <div>
                        <label for="closing_time" class="block text-sm font-medium text-gray-700">Closing Time</label>
                        <input id="closing_time" name="closing_time" type="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                    </div>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input id="phone" name="phone" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]">
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403]">
                        @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-end gap-4 mt-6">
                    <button type="button" @click="open = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#FFC403] text-[#BB7614] font-semibold rounded-md hover:bg-[#FFD54F] transition-colors">Create Shop</button>
                </div>
            </form>
        </div>
    </div>
</div>