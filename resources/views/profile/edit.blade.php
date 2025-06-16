<x-app-layout>
    <div class="bg-gradient-to-br from-emerald-50 to-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <!-- Breadcrumb Navigation -->
            <nav class="mb-8 flex items-center space-x-2 text-sm">
                <a href="{{ route('dashboard') }}" class="text-emerald-600 hover:text-emerald-700 font-medium transition-colors">
                    Dashboard
                </a>
                <span class="text-gray-400">/</span>
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

                        <!-- Profile Completion -->
                        <div class="px-6 py-4 bg-emerald-50 border-b border-emerald-100" x-data="{ 
                            completionPercentage: {{ 
                                (($user->name ? 1 : 0) + 
                                ($user->email ? 1 : 0) + 
                                ($user->phone ? 1 : 0) + 
                                ($user->address ? 1 : 0) + 
                                ($user->state ? 1 : 0) + 
                                ($user->local_government ? 1 : 0) + 
                                ($user->bio ? 1 : 0) + 
                                ($user->profile_photo ? 1 : 0)) / 8 * 100 
                            }} 
                        }">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-sm font-semibold text-emerald-900">Profile Completion</h3>
                                <span class="text-sm font-bold text-emerald-600" x-text="Math.round(completionPercentage) + '%'"></span>
                            </div>
                            <div class="w-full bg-emerald-200 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full transition-all duration-500" :style="'width: ' + completionPercentage + '%'"></div>
                            </div>
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
                                    <h3 class="font-semibold text-gray-900">About Me</h3>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    {{ $user->bio ?? 'No bio added yet. Tell us about yourself!' }}
                                </p>
                            </div>

                            <!-- Contact Information -->
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <h3 class="font-semibold text-gray-900">Contact</h3>
                                    </div>
                                    @if(!$user->phone)
                                    <div class="text-yellow-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    @endif
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
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                            </svg>
                                        </div>
                                        <h3 class="font-semibold text-gray-900">Location</h3>
                                    </div>
                                    @if(!$user->state || !$user->local_government)
                                    <div class="text-yellow-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    @endif
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
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data" id="profileForm">
                                @csrf
                                @method('patch')

                                <script>
                                    // Load states data properly
                                    const statesData = @json(json_decode(file_get_contents(public_path('data/states.json'))));
                                    console.log('States data loaded:', statesData); // Debug log

                                    function updateLGAs(selectedState) {
                                        console.log('Selected state:', selectedState); // Debug log
                                        const lgaSelect = document.getElementById('local_government');

                                        // Clear existing options
                                        lgaSelect.innerHTML = '<option value="">Select LGA</option>';

                                        if (!selectedState) {
                                            console.log('No state selected');
                                            return;
                                        }

                                        // Find the state object
                                        const stateObj = statesData.find(s => s.state === selectedState);
                                        console.log('Found state object:', stateObj); // Debug log

                                        if (stateObj && stateObj.lgas && Array.isArray(stateObj.lgas)) {
                                            console.log('LGAs for state:', stateObj.lgas); // Debug log

                                            stateObj.lgas.forEach(lga => {
                                                const option = document.createElement('option');
                                                option.value = lga;
                                                option.textContent = lga;

                                                // Check if this LGA should be selected
                                                if (lga === '{{ $user->local_government }}') {
                                                    option.selected = true;
                                                }

                                                lgaSelect.appendChild(option);
                                            });
                                        } else {
                                            console.log('No LGAs found for state:', selectedState);
                                        }
                                    }

                                    // Initialize LGAs on page load
                                    document.addEventListener('DOMContentLoaded', function() {
                                        console.log('DOM loaded, initializing LGAs');
                                        const stateSelect = document.getElementById('state');

                                        if (stateSelect && stateSelect.value) {
                                            console.log('Initial state value:', stateSelect.value);
                                            updateLGAs(stateSelect.value);
                                        }

                                        // Add event listener for state changes
                                        stateSelect.addEventListener('change', function() {
                                            console.log('State changed to:', this.value);
                                            updateLGAs(this.value);
                                            checkFormChanges(); // Check for form changes when state changes
                                        });

                                        // Initialize form change detection
                                        initFormChangeDetection();
                                    });

                                    // Track original form values and detect changes
                                    function initFormChangeDetection() {
                                        const form = document.getElementById('profileForm');
                                        const saveButton = document.getElementById('saveProfileButton');
                                        const formElements = form.querySelectorAll('input, textarea, select');

                                        // Store original values
                                        const originalValues = {};
                                        formElements.forEach(element => {
                                            if (element.type === 'file') return; // Skip file inputs
                                            if (element.name === '_token' || element.name === '_method') return; // Skip CSRF and method fields
                                            originalValues[element.name] = element.value;
                                        });

                                        // Function to check for changes
                                        window.checkFormChanges = function() {
                                            let hasChanges = false;
                                            let fileSelected = false;

                                            formElements.forEach(element => {
                                                if (element.type === 'file' && element.files.length > 0) {
                                                    fileSelected = true;
                                                } else if (element.name !== '_token' && element.name !== '_method') {
                                                    if (element.value !== originalValues[element.name]) {
                                                        hasChanges = true;
                                                    }
                                                }
                                            });

                                            // Enable/disable save button based on changes
                                            if (hasChanges || fileSelected) {
                                                saveButton.disabled = false;
                                                saveButton.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                                                saveButton.classList.add('bg-emerald-500', 'hover:bg-emerald-600', 'text-white', 'shadow-lg');
                                            } else {
                                                saveButton.disabled = true;
                                                saveButton.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                                                saveButton.classList.remove('bg-emerald-500', 'hover:bg-emerald-600', 'text-white', 'shadow-lg');
                                            }
                                        };

                                        // Add event listeners to all form elements
                                        formElements.forEach(element => {
                                            if (element.name !== '_token' && element.name !== '_method') {
                                                element.addEventListener('input', checkFormChanges);
                                                element.addEventListener('change', checkFormChanges);
                                            }
                                        });

                                        // Initial check
                                        checkFormChanges();
                                    }

                                    // Phone number edit functionality
                                    function setupPhoneEdit() {
                                        const phoneContainer = document.getElementById('phoneContainer');
                                        const phoneInput = document.getElementById('phone');
                                        const phoneDisplay = document.getElementById('phoneDisplay');
                                        const editPhoneBtn = document.getElementById('editPhoneBtn');
                                        const originalPhone = phoneInput.value;

                                        // Initial state - read-only
                                        phoneInput.readOnly = true;
                                        phoneInput.classList.add('bg-gray-50');

                                        editPhoneBtn.addEventListener('click', function() {
                                            if (phoneInput.readOnly) {
                                                // Switch to edit mode
                                                phoneInput.readOnly = false;
                                                phoneInput.classList.remove('bg-gray-50');
                                                phoneInput.classList.add('bg-white');
                                                phoneInput.value = ''; // Clear the field
                                                phoneInput.focus();
                                                editPhoneBtn.innerHTML = `
                                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                `;
                                                phoneContainer.classList.add('ring-2', 'ring-emerald-200');
                                            } else {
                                                // Cancel edit mode
                                                phoneInput.readOnly = true;
                                                phoneInput.classList.add('bg-gray-50');
                                                phoneInput.classList.remove('bg-white');
                                                phoneInput.value = originalPhone; // Restore original value
                                                editPhoneBtn.innerHTML = `
                                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                `;
                                                phoneContainer.classList.remove('ring-2', 'ring-emerald-200');
                                                checkFormChanges(); // Check if we need to re-disable the save button
                                            }
                                        });

                                        // When phone input changes, check form changes
                                        phoneInput.addEventListener('input', function() {
                                            if (!phoneInput.readOnly) {
                                                checkFormChanges();
                                            }
                                        });
                                    }

                                    // Initialize phone edit functionality when DOM is loaded
                                    document.addEventListener('DOMContentLoaded', function() {
                                        setupPhoneEdit();
                                    });
                                </script>

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
                                        <p class="mt-2 text-sm text-gray-500">
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
                                        <p class="mt-2 text-sm text-gray-500">
                                            Email cannot be changed for security reasons.
                                        </p>
                                    </div>

                                    <!-- Phone Number (Read-only with edit button) -->
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <x-input-label for="phone" :value="__('Phone Number')" class="text-gray-700 font-medium" />
                                            @if(!$user->phone)
                                            <div class="text-yellow-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                        <div id="phoneContainer" class="relative mt-1 transition-all duration-200">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="phone" name="phone" type="text" class="pl-10 pr-10 bg-gray-50 focus:border-emerald-500 focus:ring-emerald-500" :value="old('phone', $user->phone)" placeholder="Enter your phone number" />
                                            <button type="button" id="editPhoneBtn" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">
                                            Click the pencil icon to edit your phone number.
                                        </p>
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
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-emerald-50 file:text-emerald-700
                                            hover:file:bg-emerald-100" />
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                                    </div>

                                    <!-- Address -->
                                    <div class="md:col-span-2">
                                        <div class="flex items-center justify-between">
                                            <x-input-label for="address" :value="__('Address')" class="text-gray-700 font-medium" />
                                            @if(!$user->address)
                                            <div class="text-yellow-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="relative mt-1">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <x-text-input id="address" name="address" type="text" class="pl-10 focus:border-emerald-500 focus:ring-emerald-500" :value="old('address', $user->address)" placeholder="Enter your address" />
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                    </div>

                                    <!-- State -->
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <x-input-label for="state" :value="__('State')" class="text-gray-700 font-medium" />
                                            @if(!$user->state)
                                            <div class="text-yellow-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                        <select id="state" name="state" class="mt-1 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm">
                                            <option value="">Select State</option>
                                            @foreach(json_decode(file_get_contents(public_path('data/states.json'))) as $state)
                                            <option value="{{ $state->state }}" {{ old('state', $user->state) === $state->state ? 'selected' : '' }}>{{ $state->state }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('state')" />
                                    </div>

                                    <!-- Local Government -->
                                    <div>
                                        <div class="flex items-center justify-between">
                                            <x-input-label for="local_government" :value="__('Local Government')" class="text-gray-700 font-medium" />
                                            @if(!$user->local_government)
                                            <div class="text-yellow-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                        <select id="local_government" name="local_government" class="mt-1 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm">
                                            <option value="">Select LGA</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('local_government')" />
                                    </div>

                                    <!-- Bio -->
                                    <div class="md:col-span-2">
                                        <x-input-label for="bio" :value="__('Bio')" class="text-gray-700 font-medium" />
                                        <textarea id="bio" name="bio" rows="4"
                                            class="mt-1 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm"
                                            placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                                        <p class="mt-2 text-sm text-gray-500">Share a brief description about yourself, your interests, or your business.</p>
                                        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                                    <x-secondary-button type="button" onclick="window.location.href='{{ route('dashboard') }}'">
                                        Cancel
                                    </x-secondary-button>
                                    <button type="submit" id="saveProfileButton"
                                        class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-500 font-semibold rounded-xl cursor-not-allowed transition-all duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                        </svg>
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Update Password Section -->
                    <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 overflow-hidden mt-8">
                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                                <h3 class="text-xl font-bold text-white">Update Password</h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <form method="post" action="{{ route('password.update') }}" class="space-y-6" id="passwordForm">
                                @csrf
                                @method('put')

                                <div>
                                    <x-input-label for="current_password" :value="__('Current Password')" class="text-gray-700 font-medium" />
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <x-text-input id="current_password" name="current_password" type="password"
                                            class="pl-10 focus:border-emerald-500 focus:ring-emerald-500"
                                            autocomplete="current-password"
                                            placeholder="Enter your current password" />
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="password" :value="__('New Password')" class="text-gray-700 font-medium" />
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                            </svg>
                                        </div>
                                        <x-text-input id="password" name="password" type="password"
                                            class="pl-10 focus:border-emerald-500 focus:ring-emerald-500"
                                            autocomplete="new-password"
                                            placeholder="Enter your new password" />
                                    </div>
                                    <div class="mt-2 text-sm text-gray-500">
                                        <p>Password must be at least 8 characters long</p>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
                                    <div class="relative mt-1">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                            class="pl-10 focus:border-emerald-500 focus:ring-emerald-500"
                                            autocomplete="new-password"
                                            placeholder="Confirm your new password" />
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>

                                <!-- Password Validation Messages -->
                                <div id="passwordValidation" class="space-y-2 text-sm">
                                    <div id="passwordError" class="text-red-600 hidden flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <span id="passwordErrorText">Passwords do not match</span>
                                    </div>
                                    <div id="passwordSuccess" class="text-emerald-600 hidden flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Passwords match and meet requirements</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                    <div class="text-sm text-gray-500">
                                        <p>Make sure your password is strong and secure</p>
                                    </div>
                                    <button type="submit" id="savePasswordButton"
                                        class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-500 font-semibold rounded-xl cursor-not-allowed transition-all duration-300"
                                        disabled>
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                        </svg>
                                        Update Password
                                    </button>
                                </div>
                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const form = document.getElementById('passwordForm');
                                    const saveButton = document.getElementById('savePasswordButton');
                                    const passwordError = document.getElementById('passwordError');
                                    const passwordSuccess = document.getElementById('passwordSuccess');
                                    const passwordErrorText = document.getElementById('passwordErrorText');
                                    const currentPassword = document.getElementById('current_password');
                                    const newPassword = document.getElementById('password');
                                    const confirmPassword = document.getElementById('password_confirmation');

                                    function validatePasswords() {
                                        const currentPass = currentPassword.value.trim();
                                        const newPass = newPassword.value.trim();
                                        const confirmPass = confirmPassword.value.trim();

                                        // Reset validation states
                                        passwordError.classList.add('hidden');
                                        passwordSuccess.classList.add('hidden');

                                        // Check if all fields are filled
                                        if (!currentPass || !newPass || !confirmPass) {
                                            updateButtonState(false, 'Please fill in all password fields');
                                            return;
                                        }

                                        // Check minimum password length
                                        if (newPass.length < 8) {
                                            updateButtonState(false, 'New password must be at least 8 characters long');
                                            passwordErrorText.textContent = 'New password must be at least 8 characters long';
                                            passwordError.classList.remove('hidden');
                                            return;
                                        }

                                        // Check if new password is different from current
                                        if (currentPass === newPass) {
                                            updateButtonState(false, 'New password must be different from current password');
                                            passwordErrorText.textContent = 'New password must be different from current password';
                                            passwordError.classList.remove('hidden');
                                            return;
                                        }

                                        // Check if passwords match
                                        if (newPass !== confirmPass) {
                                            updateButtonState(false, 'Passwords do not match');
                                            passwordErrorText.textContent = 'Passwords do not match';
                                            passwordError.classList.remove('hidden');
                                            return;
                                        }

                                        // All validations passed
                                        updateButtonState(true, 'All validations passed');
                                        passwordSuccess.classList.remove('hidden');
                                    }

                                    function updateButtonState(isValid, message) {
                                        if (isValid) {
                                            saveButton.disabled = false;
                                            saveButton.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                                            saveButton.classList.add('bg-emerald-500', 'hover:bg-emerald-600', 'text-white', 'shadow-lg', 'hover:shadow-xl', 'transform', 'hover:scale-105');
                                        } else {
                                            saveButton.disabled = true;
                                            saveButton.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                                            saveButton.classList.remove('bg-emerald-500', 'hover:bg-emerald-600', 'text-white', 'shadow-lg', 'hover:shadow-xl', 'transform', 'hover:scale-105');
                                        }
                                        console.log('Button state:', isValid ? 'enabled' : 'disabled', '-', message);
                                    }

                                    // Add event listeners to all password fields
                                    [currentPassword, newPassword, confirmPassword].forEach(field => {
                                        field.addEventListener('input', validatePasswords);
                                        field.addEventListener('blur', validatePasswords);
                                        field.addEventListener('keyup', validatePasswords);
                                    });

                                    // Initial validation
                                    validatePasswords();

                                    // Add visual feedback for input focus
                                    [currentPassword, newPassword, confirmPassword].forEach(field => {
                                        field.addEventListener('focus', function() {
                                            this.parentElement.classList.add('ring-2', 'ring-emerald-200');
                                        });

                                        field.addEventListener('blur', function() {
                                            this.parentElement.classList.remove('ring-2', 'ring-emerald-200');
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>

                    <!-- Delete Account Section -->
                    <div class="bg-white rounded-2xl shadow-lg border border-red-100 overflow-hidden mt-8">
                        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <h3 class="text-xl font-bold text-white">Delete Account</h3>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="max-w-xl text-sm text-gray-600">
                                <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                            </div>

                            <div class="mt-6">
                                <x-danger-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                    type="button">
                                    {{ __('Delete Account') }}
                                </x-danger-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="{{ __('Password') }}" />

                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ml-3">
                            {{ __('Delete Account') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>