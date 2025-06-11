<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 py-8">
        <!-- Logo and App Name -->
        <div class="flex flex-col items-center mb-8">
            <span class="logo flex items-center text-3xl font-bold mb-2" style="font-family: 'Kelly Slab', cursive; color: #BB7614;">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                    <circle cx="24" cy="24" r="22" fill="#FFC403" stroke="#BB7614" stroke-width="3" />
                    <text x="50%" y="56%" text-anchor="middle" fill="#BB7614" font-family="'Kelly Slab', cursive" font-size="18" font-weight="bold" dy=".3em">ATM</text>
                </svg>
                MS-ATM
            </span>
            <span class="text-base text-gray-500 font-normal" style="font-family: 'Inter', sans-serif;">Welcome back</span>
        </div>

        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8" style="font-family: 'Inter', sans-serif;">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
                    <x-input-label for="email" :value="__('Email')" class="text-[#BB7614] font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] text-gray-700" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-[#BB7614] font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] text-gray-700" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#FFC403] focus:ring-[#FFC403]" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex flex-col space-y-2">
            @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-500 hover:text-[#BB7614] transition" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

                        <a class="underline text-sm text-gray-500 hover:text-[#BB7614] transition" href="{{ route('register') }}">
                            {{ __('Need an account?') }}
                        </a>
                    </div>

                    <button type="submit" class="btn-primary w-1/2 ml-auto">
                {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>