<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="flex items-center text-2xl font-bold">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" class="mr-2">
                        <circle cx="20" cy="20" r="16" fill="#FFF" />
                        <circle cx="20" cy="20" r="16" stroke="#FFD600" stroke-width="8" />
                        <path d="M14 21L19 26L27 16" stroke="#FFD600" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="text-[#BB7614] ml-2">ATM</span>
                </a>
            </div>
            <!-- Navigation Links -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-secondary hover:text-primary {{ request()->routeIs('dashboard') ? 'font-bold underline' : '' }}">Home</a>
                <a href="{{ route('search') }}" class="text-sm font-medium text-gray-700 hover:text-primary {{ request()->routeIs('search') ? 'font-bold underline' : '' }}">Search</a>
                <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-gray-700 hover:text-primary {{ request()->routeIs('profile.edit') ? 'font-bold underline' : '' }}">Account</a>
                <a href="{{ route('feedback.create') }}" class="text-sm font-medium text-gray-700 hover:text-primary {{ request()->routeIs('feedback.*') ? 'font-bold underline' : '' }}">Feedback</a>
                <a href="#" class="text-xl text-gray-700 hover:text-yellow-500">&#10084;</a>
                <a href="#" class="text-xl text-gray-700 hover:text-yellow-500">&#8594;</a>
                @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 bg-transparent border-none cursor-pointer ml-2">Logout</button>
                </form>
                @endauth
                @guest
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-primary">Login</a>
                <a href="{{ route('register') }}" class="text-sm font-medium text-gray-700 hover:text-primary">Register</a>
                @endguest
            </div>
        </div>
    </div>
</nav>