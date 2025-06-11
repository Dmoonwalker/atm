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
            <span class="text-base text-gray-500 font-normal" style="font-family: 'Inter', sans-serif;">Create your account</span>
        </div>

        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8" style="font-family: 'Inter', sans-serif;">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
                    <x-input-label for="name" :value="__('Name')" class="text-[#BB7614] font-semibold" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] text-gray-700" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" class="text-[#BB7614] font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] text-gray-700" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-[#BB7614] font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] text-gray-700" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#BB7614] font-semibold" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] text-gray-700" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="underline text-sm text-gray-500 hover:text-[#BB7614] transition" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
                    <button type="submit" class="btn-primary w-1/2 ml-auto">
                {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>