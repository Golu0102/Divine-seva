 <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://placehold.co/600x400/800000/FFFFFF?text=Experienced+Pandit"
                        alt="Pandit performing a ritual" class="rounded-xl shadow-2xl w-full">
                </div>
                <div>
                    <h2 class="section-title text-left">Why Choose {{ $setting->site_name ?? 'Divine Seva' }}?</h2>
                    <p class="mt-4 text-gray-600">{{ $setting->blog_5 ?? 'We are committed to preserving the sanctity of ancient traditions while
                        providing a modern, convenient experience for our devotees.' }}</p>
                    <ul class="mt-8 space-y-6">
                        <li class="flex items-start">
                            <div
                                class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-brand-orange text-white">
                                <i data-lucide="shield-check"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-brand-maroon">Verified & Experienced Pandits</h4>
                                <p class="text-gray-600">Our Pandits are highly knowledgeable, experienced, and have been
                                    through a rigorous verification process.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-brand-orange text-white">
                                <i data-lucide="package"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-brand-maroon">All-Inclusive Samagri</h4>
                                <p class="text-gray-600">We can provide all the necessary pooja materials (samagri), so you
                                    don't have to worry about a thing.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-full bg-brand-orange text-white">
                                <i data-lucide="indian-rupee"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-brand-maroon">Transparent Pricing</h4>
                                <p class="text-gray-600">No hidden costs. Our pricing is upfront and includes Pandit fees
                                    and samagri charges.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>