<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <nav class="mb-6 text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="hover:underline text-secondary">Home</a>
                <span>/</span>
                <span class="text-gray-700 font-semibold">Profile</span>
            </nav>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Profile Overview -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="text-center mb-6">
                            <div class="relative inline-block">
                                @if($user->profile_photo)
                                <img src="{{ Storage::url($user->profile_photo) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover">
                                @else
                                <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-4xl text-gray-400">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                @endif
                                <button type="button" class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-sm border border-gray-200 hover:bg-gray-50">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                            <h2 class="mt-4 text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Bio</h3>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->bio ?? 'No bio added yet.' }}</p>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Contact Information</h3>
                                <div class="mt-2 space-y-2">
                                    <p class="text-sm text-gray-900 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $user->phone ?? 'No phone number' }}
                                    </p>
                                    <p class="text-sm text-gray-900 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $user->address ?? 'No address' }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Location</h3>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $user->local_government ?? 'N/A' }}, {{ $user->state ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Settings -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Profile Information -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold mb-4">Profile Information</h3>
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-gray-50" :value="old('name', $user->name)" readonly disabled />
                                    <p class="mt-1 text-sm text-gray-500">Name cannot be changed for security reasons.</p>
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-gray-50" :value="old('email', $user->email)" readonly disabled />
                                    <p class="mt-1 text-sm text-gray-500">Email cannot be changed for security reasons.</p>
                                </div>

                                <div>
                                    <x-input-label for="phone" :value="__('Phone Number')" />
                                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>

                                <div>
                                    <x-input-label for="profile_photo" :value="__('Profile Photo')" />
                                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="mt-1 block w-full" />
                                    <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="bio" :value="__('Bio')" />
                                    <textarea id="bio" name="bio" rows="3" class="mt-1 block w-full border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] rounded-md shadow-sm">{{ old('bio', $user->bio) }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                                </div>

                                <div class="md:col-span-2">
                                    <x-input-label for="address" :value="__('Address')" />
                                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                </div>

                                <div>
                                    <x-input-label for="state" :value="__('State')" />
                                    <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $user->state)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('state')" />
                                </div>

                                <div>
                                    <x-input-label for="local_government" :value="__('Local Government')" />
                                    <x-text-input id="local_government" name="local_government" type="text" class="mt-1 block w-full" :value="old('local_government', $user->local_government)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('local_government')" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                    {{ __('Saved.') }}
                                </p>
                                @endif
                            </div>
                        </form>

                        @if($user->phone)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="text-lg font-semibold mb-4">WhatsApp Integration</h4>
                            <button type="button"
                                x-data
                                @click="$dispatch('open-modal')"
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#FFC403] focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Import Products from WhatsApp') }}
                            </button>
                            <p class="mt-2 text-sm text-gray-500">
                                Import your products from your WhatsApp Business catalog using your phone number.
                            </p>
                        </div>
                        @endif
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold mb-4">Update Password</h3>
                        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            @method('put')

                            <div>
                                <x-input-label for="current_password" :value="__('Current Password')" />
                                <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('New Password')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update Password') }}</x-primary-button>

                                @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                    {{ __('Saved.') }}
                                </p>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Delete Account -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold mb-4">Delete Account</h3>
                        <p class="text-sm text-gray-600 mb-4">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                        </p>

                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                            {{ __('Delete Account') }}
                        </x-danger-button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Are you sure you want to delete your account?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                </p>

                                <div class="mt-6">
                                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />
                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('Delete Account') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Products Modal -->
    <x-import-products-modal :shops="$user->shops" />
</x-app-layout>