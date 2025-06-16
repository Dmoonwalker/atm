<x-app-layout>
    <div class="bg-gradient-to-br from-emerald-50 to-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="p-2 bg-emerald-100 rounded-lg">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-emerald-900">Account Settings</h1>
                </div>
                <p class="text-gray-600">Manage your personal information and account preferences</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-white">{{ auth()->user()->name }}</h2>
                                <p class="text-emerald-100">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <button
                            x-data="{ editing: false }"
                            @click="editing = !editing"
                            class="btn-secondary flex items-center"
                            x-text="editing ? 'Cancel Edit' : 'Edit Profile'">
                        </button>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="p-8">
                    <form method="POST" action="{{ route('account.update') }}" class="space-y-8"
                        x-data="{ 
                            editing: false,
                            isDirty: false,
                            originalValues: {
                                name: '{{ auth()->user()->name }}',
                                email: '{{ auth()->user()->email }}',
                                phone: '{{ auth()->user()->phone }}',
                                password: ''
                            },
                            checkDirty() {
                                this.isDirty = 
                                    this.$refs.name.value !== this.originalValues.name ||
                                    this.$refs.email.value !== this.originalValues.email ||
                                    this.$refs.phone.value !== this.originalValues.phone ||
                                    (this.$refs.password.value && this.$refs.password.value.length > 0);
                            }
                        }"
                        @input="checkDirty">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information Section -->
                        <div>
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="p-2 bg-emerald-100 rounded-lg">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Personal Information</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="form-label">Full Name</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            x-ref="name"
                                            value="{{ auth()->user()->name }}"
                                            x-bind:disabled="!editing"
                                            class="form-input pl-10"
                                            :class="editing ? '' : 'bg-gray-50 cursor-not-allowed'"
                                            required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                            </svg>
                                        </div>
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            x-ref="email"
                                            value="{{ auth()->user()->email }}"
                                            x-bind:disabled="!editing"
                                            class="form-input pl-10"
                                            :class="editing ? '' : 'bg-gray-50 cursor-not-allowed'"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="border-t border-gray-200 pt-8">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Contact Information</h3>
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    @if(!auth()->user()->phone)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        Required
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Verified
                                    </span>
                                    @endif
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <input
                                        type="tel"
                                        name="phone"
                                        id="phone"
                                        x-ref="phone"
                                        value="{{ auth()->user()->phone }}"
                                        x-bind:disabled="!editing"
                                        class="form-input pl-10"
                                        :class="editing ? '' : 'bg-gray-50 cursor-not-allowed'"
                                        placeholder="Enter your phone number"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Security Section -->
                        <div class="border-t border-gray-200 pt-8">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Security Settings</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- New Password -->
                                <div>
                                    <label for="password" class="form-label">New Password</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            x-ref="password"
                                            x-bind:disabled="!editing"
                                            class="form-input pl-10"
                                            :class="editing ? '' : 'bg-gray-50 cursor-not-allowed'"
                                            placeholder="Enter new password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-8 border-t border-gray-200">
                            <button type="button" @click="editing = false; isDirty = false"
                                class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>
                            <button type="submit"
                                x-bind:disabled="!editing || !isDirty"
                                class="px-6 py-3 bg-emerald-500 text-white font-semibold rounded-xl transition-colors"
                                :class="(!editing || !isDirty) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-emerald-600'">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Additional Security Options -->
            <div class="mt-8 bg-white rounded-2xl shadow-lg border border-emerald-100 p-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Account Security</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">Two-Factor Authentication</h4>
                        <p class="text-sm text-gray-600 mb-4">Add an extra layer of security to your account</p>
                        <button class="btn-outline text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Enable 2FA
                        </button>
                    </div>

                    <div class="p-4 border border-red-200 rounded-lg bg-red-50">
                        <h4 class="font-medium text-red-900 mb-2">Delete Account</h4>
                        <p class="text-sm text-red-700 mb-4">Permanently delete your account and all data</p>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>