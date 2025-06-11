<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Shop At The Moment (MS-ATM)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Kelly+Slab&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <nav class="bg-white shadow-md">
        <div class="container flex items-center justify-between py-4">
            <div class="flex items-center space-x-3">
                <span class="logo flex items-center text-2xl font-bold">
                    <svg width="36" height="36" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                        <circle cx="24" cy="24" r="22" fill="#FFC403" stroke="#BB7614" stroke-width="3" />
                        <text x="50%" y="56%" text-anchor="middle" fill="#BB7614" font-family="'Kelly Slab', cursive" font-size="18" font-weight="bold" dy=".3em">ATM</text>
                    </svg>
                    MS-ATM
                </span>
            </div>
            <div class="space-x-4 flex items-center">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="btn-secondary">Log in</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn-outline">Register</a>
                @endif
                @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="py-20 px-4">
            <div class="container mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h1 class="section-title">Your Shop, Your Moment</h1>
                        <p class="text-xl mb-8 text-gray-600">
                            Display your products and services in real-time. Keep your customers updated and engaged with your business at all times.
                        </p>
                        <div class="space-x-4">
                            <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                            <a href="#features" class="btn-outline">Learn More</a>
                        </div>
                    </div>
                    <div class="relative">
                        <img src="/images/hero-image.png" alt="MS-ATM Platform" class="rounded-lg shadow-xl w-full">
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-gray-100">
            <div class="container mx-auto px-4">
                <h2 class="section-title text-center">How It Works</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Create Your Shop</h3>
                        <p class="text-gray-600">Sign up and add your business details to create your personalized shop page.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Add Products</h3>
                        <p class="text-gray-600">Upload your products with images, descriptions, and real-time availability.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Share & Connect</h3>
                        <p class="text-gray-600">Generate QR codes, share your shop, and keep customers updated in real-time.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20" style="background-color: var(--primary-brown);">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold mb-8 text-white">Ready to Showcase Your Business?</h2>
                <p class="text-xl mb-12 max-w-2xl mx-auto text-white">Join MS-ATM today and start connecting with your customers in real-time.</p>
                <a href="{{ route('register') }}" class="btn-primary">Start Your Free Trial</a>
            </div>
        </section>
    </main>

    <footer class="bg-white border-t">
        <div class="container mx-auto px-4 py-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="logo text-2xl font-bold mb-4">MS-ATM</h3>
                    <p class="text-gray-600">Your business, your moment, all in one place.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/features" class="text-gray-600 hover:text-[#BB7614] transition">Features</a></li>
                        <li><a href="/pricing" class="text-gray-600 hover:text-[#BB7614] transition">Pricing</a></li>
                        <li><a href="/about" class="text-gray-600 hover:text-[#BB7614] transition">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="/help" class="text-gray-600 hover:text-[#BB7614] transition">Help Center</a></li>
                        <li><a href="/contact" class="text-gray-600 hover:text-[#BB7614] transition">Contact Us</a></li>
                        <li><a href="/faq" class="text-gray-600 hover:text-[#BB7614] transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="/privacy" class="text-gray-600 hover:text-[#BB7614] transition">Privacy Policy</a></li>
                        <li><a href="/terms" class="text-gray-600 hover:text-[#BB7614] transition">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t mt-8 pt-8 text-center text-gray-600">
                &copy; {{ date('Y') }} My Shop At The Moment (MS-ATM). All rights reserved.
            </div>
        </div>
    </footer>
</body>

</html>