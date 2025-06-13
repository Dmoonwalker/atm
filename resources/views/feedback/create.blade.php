<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <nav class="mb-6 text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="hover:underline text-secondary">Home</a>
                <span>/</span>
                <span class="text-gray-700 font-semibold">Feedback</span>
            </nav>

            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Send Feedback</h2>

                    @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('feedback.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', $user?->name)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    :value="old('email', $user?->email)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="subject" :value="__('Subject')" />
                            <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full"
                                :value="old('subject')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                        </div>

                        <div>
                            <x-input-label for="type" :value="__('Type')" />
                            <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] rounded-md shadow-sm" required>
                                <option value="">Select a type</option>
                                <option value="bug" {{ old('type') == 'bug' ? 'selected' : '' }}>Bug Report</option>
                                <option value="feature" {{ old('type') == 'feature' ? 'selected' : '' }}>Feature Request</option>
                                <option value="complaint" {{ old('type') == 'complaint' ? 'selected' : '' }}>Complaint</option>
                                <option value="suggestion" {{ old('type') == 'suggestion' ? 'selected' : '' }}>Suggestion</option>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>

                        <div>
                            <x-input-label for="message" :value="__('Message')" />
                            <textarea id="message" name="message" rows="6"
                                class="mt-1 block w-full border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] rounded-md shadow-sm"
                                required>{{ old('message') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('message')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Submit Feedback') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>