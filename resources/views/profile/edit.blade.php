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
                <span class="text-gray-700 font-semibold">Profile</span>
            </nav>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Profile Overview -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 overflow-hidden">
                        <!-- Profile Header -->
                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-8 text-center">
                            <div class="relative inline-block mb-4">
                                @if($user->profile_photo)
                                <img src="{{ $user->profile_photo }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                                @else
                                <div class="w-32 h-32 rounded-full bg-white bg-opacity-20 border-4 border-white shadow-lg flex items-center justify-center">
                                    <span class="text-4xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                @endif
                                <label for="profile_photo" class="absolute bottom-2 right-2 bg-white rounded-full p-2 shadow-lg border border-emerald-200 hover:bg-emerald-50 cursor-pointer transition-colors group">
                                    <svg class="w-4 h-4 text-emerald-600 group-hover:text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </label>
                            </div>
                            <h2 class="text-2xl font-bold text-white mb-1">{{ $user->name }}</h2>
                            <p class="text-emerald-100">{{ $user->email }}</p>
                        </div>

                        <!-- Profile Details -->
                        <div class="p-6 space-y-6">
                            <!-- Bio Section -->
                            <div>
                                <div class="flex items-center mb-3">
                                    <div class="p-2 bg-emerald-100 rounded-lg mr-3">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-gray-900">Bio</h3>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    {{ $user->bio ?? 'No bio added yet. Tell us about yourself!' }}
                                </p>
                            </div>

                            <!-- Contact Information -->
                            <div>
                                <div class="flex items-center mb-3">
                                    <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-gray-900">Contact</h3>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span class="text-gray-700">{{ $user->phone ?? 'No phone number' }}</span>
                                    </div>
                                    <div class="flex items-start text-sm">
                                        <svg class="w-4 h-4 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-gray-700">{{ $user->address ?? 'No address provided' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div>
                                <div class="flex items-center mb-3">
                                    <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-gray-900">Location</h3>
                                </div>
                                <p class="text-sm text-gray-700">
                                    {{ $user->local_government ?? 'N/A' }}, {{ $user->state ?? 'N/A' }}
                                </p>
                            </div>

                            <!-- Account Stats -->
                            <div class="pt-4 border-t border-gray-200">
                                <div class="flex items-center mb-3">
                                    <div class="p-2 bg-orange-100 rounded-lg mr-3">
                                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-gray-900">Account Info</h3>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <p>Member since {{ $user->created_at->format('M Y') }}</p>
                                    <p class="mt-1">Last updated {{ $user->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Settings -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Profile Information -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <h3 class="text-xl font-bold text-white">Profile Information</h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Name (Read-only) -->
                                    <div>
                                        <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium" />
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="name" name="name" type="text" class="pl-10 bg-gray-50 cursor-not-allowed" :value="old('name', $user->name)" readonly disabled />
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            Name cannot be changed for security reasons.
                                        </p>
                                    </div>

                                    <!-- Email (Read-only) -->
                                    <div>
                                        <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                </svg>
                                            </div>
                                            <x-text-input id="email" name="email" type="email" class="pl-10 bg-gray-50 cursor-not-allowed" :value="old('email', $user->email)" readonly disabled />
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            Email cannot be changed for security reasons.
                                        </p>
                                    </div>

                                    <!-- Phone Number -->
                                    <div>
                                        <x-input-label for="phone" :value="__('Phone Number')" class="text-gray-700 font-medium" />
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="phone" name="phone" type="text" class="pl-10 focus:border-emerald-500 focus:ring-emerald-500" :value="old('phone', $user->phone)" placeholder="Enter your phone number" />
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                    </div>

                                    <!-- Profile Photo -->
                                    <div>
                                        <x-input-label for="profile_photo" :value="__('Profile Photo')" class="text-gray-700 font-medium" />
                                        <div class="mt-1">
                                            <input type="file"
                                                id="profile_photo"
                                                name="profile_photo"
                                                accept="image/*"
                                                class="block w-full text-sm text-gray-500
                                                          file:mr-4 file:py-2 file:px-4
                                                          file:rounded-lg file:border-0
                                                          file:text-sm file:font-semibold
                                                          file:bg-emerald-500 file:text-white
                                                          hover:file:bg-emerald-600 transition-colors" />
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">PNG, JPG or JPEG (max. 2MB)</p>
                                        <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                                    </div>

                                    <!-- Bio -->
                                    <div class="md:col-span-2">
                                        <x-input-label for="bio" :value="__('Bio')" class="text-gray-700 font-medium" />
                                        <div class="mt-1">
                                            <textarea id="bio" name="bio" rows="4"
                                                class="block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-lg shadow-sm resize-none"
                                                placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                                    </div>

                                    <!-- Address -->
                                    <div class="md:col-span-2">
                                        <x-input-label for="address" :value="__('Address')" class="text-gray-700 font-medium" />
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="address" name="address" type="text" class="pl-10 focus:border-emerald-500 focus:ring-emerald-500" :value="old('address', $user->address)" placeholder="Enter your full address" />
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                    </div>

                                    <!-- State -->
                                    <div>
                                        <x-input-label for="state" :value="__('State')" class="text-gray-700 font-medium" />
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                                </svg>
                                            </div>
                                            <x-text-input id="state" name="state" type="text" class="pl-10 focus:border-emerald-500 focus:ring-emerald-500" :value="old('state', $user->state)" placeholder="Enter your state" />
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('state')" />
                                    </div>

                                    <!-- Local Government -->
                                    <div>
                                        <x-input-label for="local_government" :value="__('Local Government')" class="text-gray-700 font-medium" />
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0v-3.28a1 1 0 01.684-.948l1.923-.641a1 1 0 00.632-.928c0-.513.492-.926 1.1-.926h4.522c.608 0 1.1.413 1.1.926 0 .408.21.783.632.928l1.923.641a1 1 0 01.684.948V21" />
                                                </svg>
                                            </div>
                                            <x-text-input id="local_government" name="local_government" type="text" class="pl-10 focus:border-emerald-500 focus:ring-emerald-500" :value="old('local_government', $user->local_government)" placeholder="Enter your local government" />
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('local_government')" />
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                    <div class="text-sm text-gray-500">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Changes will be saved to your profile
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <x-primary-button class="bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ __('Save Changes') }}
                                        </x-primary-button>

                                        @if (session('status') === 'profile-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                            class="text-sm text-emerald-600 font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ __('Saved successfully!') }}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </form>

                            <!-- WhatsApp Integration -->
                            @if($user->phone)
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <div class="flex items-center mb-4">
                                    <div class="p-2 bg-green-100 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.309" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900">WhatsApp Integration</h4>
                                </div>
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <p class="text-sm text-green-800 mb-4">
                                        Import your products from your WhatsApp Business catalog using your phone number.
                                    </p>
                                    <button type="button"
                                        x-data
                                        @click="$dispatch('open-modal')"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.309" />
                                        </svg>
                                        {{ __('Import Products from WhatsApp') }}
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <h3 class="text-xl font-bold text-white">Update Password</h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                                @csrf
                                @method('put')

                                <div class="space-y-6">
                                    <!-- Current Password -->
                                    <div>
                                        <x-input-label for="current_password" :value="__('Current Password')" class="text-gray-700 font-medium" />
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="current_password" name="current_password" type="password" class="pl-10 focus:border-purple-500 focus:ring-purple-500" autocomplete="current-password" placeholder="Enter current password" />
                                        </div>
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                    </div>

                                    <!-- New Password -->
                                    <div>
                                        <x-input-label for="password" :value="__('New Password')" class="text-gray-700 font-medium" />
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="password" name="password" type="password" class="pl-10 focus:border-purple-500 focus:ring-purple-500" autocomplete="new-password" placeholder="Enter new password" />
                                        </div>
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="pl-10 focus:border-purple-500 focus:ring-purple-500" autocomplete="new-password" placeholder="Confirm new password" />
                                        </div>
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Password Requirements -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Password Requirements:</h4>
                                    <ul class="text-sm text-gray-600 space-y-2">
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            At least 8 characters long
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Contains uppercase and lowercase letters
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Contains at least one number or special character
                                        </li>
                                    </ul>
                                </div>

                                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                    <div class="text-sm text-gray-500">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Your password will be encrypted and secure
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <x-primary-button class="bg-purple-600 hover:bg-purple-700 focus:ring-purple-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            {{ __('Update Password') }}
                                        </x-primary-button>

                                        @if (session('status') === 'password-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                            class="text-sm text-emerald-600 font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ __('Password updated!') }}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="bg-white rounded-2xl shadow-lg border border-red-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <h3 class="text-xl font-bold text-white">Danger Zone</h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <div>
                                        <h4 class="text-sm font-medium text-red-900 mb-1">Delete Account</h4>
                                        <p class="text-sm text-red-700">
                                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-red-600 hover:bg-red-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                {{ __('Delete Account') }}
                            </x-danger-button>

                            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <div class="flex items-center mb-4">
                                        <div class="p-3 bg-red-100 rounded-full mr-4">
                                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                        <h2 class="text-xl font-bold text-gray-900">
                                            {{ __('Are you sure you want to delete your account?') }}
                                        </h2>
                                    </div>

                                    <p class="text-gray-600 mb-6">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                    </p>

                                    <div class="mb-6">
                                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="password" name="password" type="password" class="pl-10 w-full" placeholder="{{ __('Enter your password to confirm') }}" />
                                        </div>
                                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                    </div>

                                    <div class="flex justify-end space-x-4">
                                        <x-secondary-button x-on:click="$dispatch('close')" class="px-6">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>

                                        <x-danger-button class="px-6 bg-red-600 hover:bg-red-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
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
    </div>

    <!-- Import Products Modal -->
    <x-import-products-modal :shops="$user->shops" />
</x-app-layout>