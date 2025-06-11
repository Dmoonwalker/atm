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
        <span class="text-base text-gray-500 font-normal" style="font-family: 'Inter', sans-serif;">Forgot your password?</span>
    </div>

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8" style="font-family: 'Inter', sans-serif;">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-[#BB7614] font-semibold" />
                <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403]" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="btn-primary w-1/2 ml-auto">{{ __('Email Password Reset Link') }}</button>
            </div>
        </form>
    </div>
</div>