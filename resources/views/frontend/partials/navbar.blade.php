<header class="bg-white/80 backdrop-blur-lg shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                @if ($setting && $setting->logo)
                    <img src="{{ asset($setting->logo) }}" alt="Divine Seva Logo"
                        class="rounded-full w-10 h-10 object-cover">
                @else
                    <img src="https://placehold.co/40x40/FF6D2E/FFFFFF?text=DS" alt="Logo" class="rounded-full">
                @endif
                <span class="text-2xl font-laila font-bold text-brand-maroon">
                    {{ $setting->site_name ?? 'Divine Seva' }}
                </span>
            </a>


            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}#home"
                    class="text-gray-600 hover:text-brand-orange transition duration-300">Home</a>
                <a href="{{ url('/') }}#services"
                    class="text-gray-600 hover:text-brand-orange transition duration-300">Poojas</a>
                <a href="{{ url('/') }}#process"
                    class="text-gray-600 hover:text-brand-orange transition duration-300">How It Works</a>
                <a href="{{ url('/') }}#pandits"
                    class="text-gray-600 hover:text-brand-orange transition duration-300">Our Pandits</a>
                <a href="{{ url('/') }}#contact"
                    class="text-gray-600 hover:text-brand-orange transition duration-300">Contact</a>
            </nav>

            <!-- CTA Button -->
            <div class="hidden md:block">
                <a href="{{ route('book.pooja.form') }}"
                    class="bg-brand-orange text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-opacity-90 transition duration-300">
                    Book a Pooja
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden px-4 pt-2 pb-4 space-y-2 bg-white">
        <a href="{{ url('/') }}#home" class="block text-gray-600 hover:text-brand-orange py-2">Home</a>
        <a href="{{ url('/') }}#services" class="block text-gray-600 hover:text-brand-orange py-2">Poojas</a>
        <a href="{{ url('/') }}#process" class="block text-gray-600 hover:text-brand-orange py-2">How It Works</a>
        <a href="{{ url('/') }}#pandits" class="block text-gray-600 hover:text-brand-orange py-2">Our Pandits</a>
        <a href="{{ url('/') }}#contact" class="block text-gray-600 hover:text-brand-orange py-2">Contact</a>
        <a href="{{ url('/') }}#booking"
            class="block bg-brand-orange text-white text-center font-semibold mt-4 px-6 py-3 rounded-lg hover:bg-opacity-90 transition duration-300">Book
            a Pooja</a>
    </div>
</header>
