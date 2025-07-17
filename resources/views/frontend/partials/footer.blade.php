<footer id="contact" class="bg-brand-maroon text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- About -->
            <div class="md:col-span-1">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    @if ($setting && $setting->logo)
                        <img src="{{ asset($setting->logo) }}" alt="Logo" class="rounded-full w-10 h-10 object-cover">
                    @else
                        <img src="https://placehold.co/40x40/FF6D2E/FFFFFF?text=DS" alt="Logo" class="rounded-full">
                    @endif
                    <span class="text-2xl font-laila font-bold text-white"> {{ $setting->site_name ?? 'Divine Seva' }}</span>
                </a>
                <p class="mt-4 text-gray-300">
                    {{ $setting->blog_7 ?? 'Trusted partner for authentic Vedic poojas.' }}</p>

                <div class="mt-6 flex space-x-4">
                    @if ($setting->facebook)
                        <a href="{{ $setting->facebook }}" target="_blank" class="text-gray-300 hover:text-brand-orange"><i
                                data-lucide="facebook"></i></a>
                    @endif
                    @if ($setting->instagram)
                        <a href="{{ $setting->instagram }}" target="_blank" class="text-gray-300 hover:text-brand-orange"><i
                                data-lucide="instagram"></i></a>
                    @endif
                    @if ($setting->youtube)
                        <a href="{{ $setting->youtube }}" target="_blank" class="text-gray-300 hover:text-brand-orange"><i
                                data-lucide="youtube"></i></a>
                    @endif
                    @if ($setting->twitter)
                        <a href="{{ $setting->twitter }}" target="_blank" class="text-gray-300 hover:text-brand-orange"><i
                                data-lucide="twitter"></i></a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-laila text-lg font-semibold tracking-wider text-white">Quick Links</h4>
                <ul class="mt-4 space-y-2">
                    <li><a href="{{ url('/') }}#home" class="text-gray-300 hover:text-white">Home</a></li>
                    <li><a href="{{ url('/') }}#services" class="text-gray-300 hover:text-white">Poojas</a></li>
                    <li><a href="{{ url('/') }}#pandits" class="text-gray-300 hover:text-white">Our Pandits</a>
                    </li>
                    <li><a href="#" class="text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="font-laila text-lg font-semibold tracking-wider text-white">Services</h4>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-white">Satyanarayan Pooja</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white">Griha Pravesh</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white">Vastu Shanti</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white">Wedding Ceremony</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="font-laila text-lg font-semibold tracking-wider text-white">Contact Us</h4>
                <ul class="mt-4 space-y-3 text-gray-300">
                    <li class="flex items-start">
                        <i data-lucide="map-pin" class="w-5 h-5 mr-3 mt-1 flex-shrink-0"></i>
                        <span>{{ $setting->address ?? '123 Temple Street, Divine Nagar, India' }}</span>
                    </li>
                    <li class="flex items-center">
                        <i data-lucide="phone" class="w-5 h-5 mr-3"></i>
                        <a href="tel:{{ $setting->mobile }}"
                            class="hover:text-white">{{ $setting->mobile ?? '+91 12345 67890' }}</a>
                    </li>
                    <li class="flex items-center">
                        <i data-lucide="mail" class="w-5 h-5 mr-3"></i>
                        <a href="mailto:{{ $setting->email }}"
                            class="hover:text-white">{{ $setting->email ?? 'seva@divine.com' }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-12 border-t border-gray-600 pt-8 text-center text-gray-400">
            <p>&copy; {{ now()->year }}  {{ $setting->site_name ?? 'Divine Seva' }}. {{ $setting->footer_text ?? 'All Rights Reserved.' }}</p>
        </div>
    </div>
</footer>
