<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Account Settings</h2>
                        <button
                            x-data="{ editing: false }"
                            @click="editing = !editing"
                            x-text="editing ? 'Cancel' : 'Edit Profile'"
                            class="px-4 py-2 bg-[#FFC403] text-[#BB7614] font-semibold rounded-md hover:bg-[#FFD54F] transition-colors">
                        </button>
                    </div>

                    <form method="POST" action="{{ route('account.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ auth()->user()->name }}"
                                x-data="{ editing: false }"
                                x-bind:disabled="!editing"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] disabled:bg-gray-100 disabled:text-gray-500"
                                required>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ auth()->user()->email }}"
                                x-data="{ editing: false }"
                                x-bind:disabled="!editing"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] disabled:bg-gray-100 disabled:text-gray-500"
                                required>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <div class="flex items-center gap-2">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                @if(!auth()->user()->phone)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Required
                                </span>
                                @endif
                            </div>
                            <div class="mt-1 relative">
                                <input
                                    type="tel"
                                    name="phone"
                                    id="phone"
                                    value="{{ auth()->user()->phone }}"
                                    x-data="{ editing: false }"
                                    x-bind:disabled="!editing"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] disabled:bg-gray-100 disabled:text-gray-500"
                                    placeholder="Enter your phone number"
                                    required>
                                @if(!auth()->user()->phone)
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                            @if(!auth()->user()->phone)
                            <p class="mt-2 text-sm text-red-600">
                                Please add your phone number for important notifications and account security.
                            </p>
                            @endif
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                x-data="{ editing: false }"
                                x-bind:disabled="!editing"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] disabled:bg-gray-100 disabled:text-gray-500"
                                placeholder="Leave blank to keep current password">
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                x-data="{ editing: false }"
                                x-bind:disabled="!editing"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#FFC403] focus:ring-[#FFC403] disabled:bg-gray-100 disabled:text-gray-500"
                                placeholder="Confirm new password">
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button
                                type="submit"
                                x-data="{ editing: false }"
                                x-show="editing"
                                class="px-4 py-2 bg-[#FFC403] text-[#BB7614] font-semibold rounded-md hover:bg-[#FFD54F] transition-colors">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>