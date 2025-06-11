<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="flex items-center text-2xl font-bold">
                    <span class="text-[#BB7614] ml-2">ATM</span>
                </a>
            </div>
            <!-- Navigation Links -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-secondary hover:text-primary {{ request()->routeIs('dashboard') ? 'font-bold underline' : '' }}">Home</a>
                <a href="{{ route('search') }}" class="text-sm font-medium text-gray-700 hover:text-primary {{ request()->routeIs('search') ? 'font-bold underline' : '' }}">Search</a>
                <a href="#" class="text-sm font-medium text-gray-700 hover:text-yellow-500">Account</a>
                <a href="#" class="text-sm font-medium text-gray-700 hover:text-yellow-500">Feedback</a>
                <a href="#" class="text-xl text-gray-700 hover:text-yellow-500">&#10084;</a>
                <a href="#" class="text-xl text-gray-700 hover:text-yellow-500">&#8594;</a>
            </div>
        </div>
    </div>
</nav>