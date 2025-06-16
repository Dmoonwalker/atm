<x-app-layout>
    <div class="bg-gradient-to-br from-emerald-50 to-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-10">
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
                <span class="text-gray-700 font-semibold">Feedback</span>
            </nav>

            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-3">
                    <div class="p-3 bg-emerald-100 rounded-xl">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold text-emerald-900">Send Feedback</h1>
                        <p class="text-gray-600 mt-1">Help us improve by sharing your thoughts and suggestions</p>
                    </div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto">
                <!-- Main Feedback Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-emerald-100 overflow-hidden">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-white bg-opacity-20 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </div>
                            <div class="text-white">
                                <h2 class="text-2xl font-bold">Your Voice Matters</h2>
                                <p class="text-emerald-100">Share your feedback to help us serve you better</p>
                            </div>
                        </div>
                    </div>

                    <!-- Success Message -->
                    @if (session('status'))
                    <div class="mx-8 mt-8 p-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="font-medium">{{ session('status') }}</span>
                        </div>
                    </div>
                    @endif

                    <!-- Form Content -->
                    <div class="p-8">
                        <form method="POST" action="{{ route('feedback.store') }}" class="space-y-8"
                            x-data="{ 
                                completionPercentage: 0,
                                isDirty: false,
                                originalValues: {
                                    name: '{{ old('name', $user?->name) }}',
                                    email: '{{ old('email', $user?->email) }}',
                                    subject: '{{ old('subject') }}',
                                    type: '{{ old('type') }}',
                                    message: '{{ old('message') }}'
                                },
                                checkDirty() {
                                    this.isDirty = 
                                        this.$refs.name.value !== this.originalValues.name ||
                                        this.$refs.email.value !== this.originalValues.email ||
                                        this.$refs.subject.value !== this.originalValues.subject ||
                                        this.$refs.type.value !== this.originalValues.type ||
                                        this.$refs.message.value !== this.originalValues.message;
                                },
                                updateCompletionPercentage() {
                                    let completed = 0;
                                    let total = 5; // Total number of required fields
                                    
                                    if (this.$refs.name.value) completed++;
                                    if (this.$refs.email.value) completed++;
                                    if (this.$refs.subject.value) completed++;
                                    if (this.$refs.type.value) completed++;
                                    if (this.$refs.message.value) completed++;
                                    
                                    this.completionPercentage = Math.round((completed / total) * 100);
                                    this.checkDirty();
                                }
                            }"
                            @input="updateCompletionPercentage">
                            @csrf

                            <!-- Form Completion Progress -->
                            <div class="bg-emerald-50 rounded-xl p-4 border border-emerald-100">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-sm font-semibold text-emerald-900">Form Completion</h3>
                                    <span class="text-sm font-bold text-emerald-600" x-text="completionPercentage + '%'"></span>
                                </div>
                                <div class="w-full bg-emerald-200 rounded-full h-2">
                                    <div class="bg-emerald-500 h-2 rounded-full transition-all duration-500" :style="'width: ' + completionPercentage + '%'"></div>
                                </div>
                            </div>

                            <!-- Personal Information Section -->
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
                                <div class="flex items-center mb-6">
                                    <div class="p-2 bg-blue-500 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Contact Information</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <label for="name" class="block text-sm font-bold text-gray-700">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                Full Name
                                            </label>
                                            <div x-show="!$refs.name.value" class="text-yellow-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <input id="name" name="name" type="text" x-ref="name"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                            value="{{ old('name', $user?->name) }}"
                                            placeholder="Enter your full name" required>
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>

                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <label for="email" class="block text-sm font-bold text-gray-700">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                Email Address
                                            </label>
                                            <div x-show="!$refs.email.value" class="text-yellow-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <input id="email" name="email" type="email" x-ref="email"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                            value="{{ old('email', $user?->email) }}"
                                            placeholder="Enter your email address" required>
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                    </div>
                                </div>
                            </div>

                            <!-- Feedback Details Section -->
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200">
                                <div class="flex items-center mb-6">
                                    <div class="p-2 bg-purple-500 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Feedback Details</h3>
                                </div>

                                <div class="space-y-6">
                                    <!-- Subject -->
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <label for="subject" class="block text-sm font-bold text-gray-700">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                </svg>
                                                Subject
                                            </label>
                                            <div x-show="!$refs.subject.value" class="text-yellow-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <input id="subject" name="subject" type="text" x-ref="subject"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                            value="{{ old('subject') }}"
                                            placeholder="Brief description of your feedback" required>
                                        <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                                    </div>

                                    <!-- Type -->
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <label for="type" class="block text-sm font-bold text-gray-700">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                                Feedback Type
                                            </label>
                                            <div x-show="!$refs.type.value" class="text-yellow-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <select id="type" name="type" x-ref="type"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all" required>
                                            <option value="">Select feedback type</option>
                                            <option value="bug" {{ old('type') == 'bug' ? 'selected' : '' }}>
                                                🐛 Bug Report - Something isn't working
                                            </option>
                                            <option value="feature" {{ old('type') == 'feature' ? 'selected' : '' }}>
                                                ✨ Feature Request - New functionality
                                            </option>
                                            <option value="complaint" {{ old('type') == 'complaint' ? 'selected' : '' }}>
                                                😞 Complaint - Issue with service
                                            </option>
                                            <option value="suggestion" {{ old('type') == 'suggestion' ? 'selected' : '' }}>
                                                💡 Suggestion - Improvement idea
                                            </option>
                                            <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>
                                                📝 Other - General feedback
                                            </option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                                    </div>
                                </div>
                            </div>

                            <!-- Message Section -->
                            <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-6 border border-orange-200">
                                <div class="flex items-center mb-6">
                                    <div class="p-2 bg-orange-500 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900">Your Message</h3>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label for="message" class="block text-sm font-bold text-gray-700">
                                            Detailed Message
                                        </label>
                                        <div x-show="!$refs.message.value" class="text-yellow-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <textarea id="message" name="message" rows="6" x-ref="message"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all"
                                        placeholder="Please provide detailed information about your feedback. The more specific you are, the better we can help you." required>{{ old('message') }}</textarea>
                                    <p class="text-sm text-gray-500 mt-2">Be as detailed as possible to help us understand and address your feedback effectively.</p>
                                    <x-input-error class="mt-2" :messages="$errors->get('message')" />
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end pt-6 border-t border-gray-200">
                                <button type="submit"
                                    class="inline-flex items-center px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition-colors shadow-lg hover:shadow-xl transform hover:scale-105"
                                    :class="completionPercentage < 100 || !isDirty ? 'opacity-50 cursor-not-allowed' : ''"
                                    :disabled="completionPercentage < 100 || !isDirty">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                    Submit Feedback
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="mt-8 bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-blue-100 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Need Help?</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <h4 class="font-semibold text-gray-900 mb-2">🐛 Reporting Bugs</h4>
                            <p class="text-gray-600">Include steps to reproduce, expected vs actual behavior, and your device/browser info.</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <h4 class="font-semibold text-gray-900 mb-2">✨ Feature Requests</h4>
                            <p class="text-gray-600">Describe the feature, why it would be useful, and how you envision it working.</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <h4 class="font-semibold text-gray-900 mb-2">💡 General Feedback</h4>
                            <p class="text-gray-600">Share your overall experience, suggestions for improvement, or any other thoughts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>