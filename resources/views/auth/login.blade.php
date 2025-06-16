<x-guest-layout>
    <div class="auth-container">
        <div class="auth-card">
            <!-- Logo and App Name -->
            <div class="auth-header">
                <div class="flex items-center justify-center mb-4">
                    <!-- Modern Green Logo -->
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <!-- Bank/ATM Icon -->
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0v-3.28a1 1 0 01.684-.948l1.923-.641a1 1 0 00.632-.928c0-.513.492-.926 1.1-.926h4.522c.608 0 1.1.413 1.1.926 0 .408.21.783.632.928l1.923.641a1 1 0 01.684.948V21" />
                            </svg>
                        </div>
                        <!-- Small indicator dot -->
                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-300 rounded-full border-2 border-white"></div>
                    </div>
                </div>

                <h1 class="auth-title">MS-ATM</h1>
                <p class="auth-subtitle">Welcome back! Please sign in to your account</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email Address')" class="form-label" />
                    <div class="relative">
                        <!-- Email Icon -->
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <x-text-input
                            id="email"
                            class="form-input pl-10"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter your email address" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="form-label" />
                    <div class="relative">
                        <!-- Lock Icon -->
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <x-text-input
                            id="password"
                            class="form-input pl-10"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="h-4 w-4 text-emerald-500 focus:ring-emerald-500 border-gray-300 rounded"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a class="text-sm text-emerald-600 hover:text-emerald-500 font-medium transition-colors duration-200" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="space-y-4">
                    <button type="submit" class="btn-primary w-full justify-center">
                        <!-- Login Icon -->
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        {{ __('Sign In') }}
                    </button>

                    <!-- Register Link -->
                    <div class="text-center">
                        <span class="text-sm text-gray-600">{{ __("Don't have an account?") }}</span>
                        <a class="text-sm text-emerald-600 hover:text-emerald-500 font-medium ml-1 transition-colors duration-200" href="{{ route('register') }}">
                            {{ __('Create one here') }}
                        </a>
                    </div>
                </div>
            </form>

            <!-- Additional Security Info -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-center text-xs text-gray-500">
                    <!-- Shield Icon -->
                    <svg class="w-4 h-4 mr-1 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    {{ __('Your data is protected with bank-level security') }}
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>