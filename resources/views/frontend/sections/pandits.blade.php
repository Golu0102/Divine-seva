<!-- =========== Our Pandits Section =========== -->
<section id="pandits" class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title">Meet Our Expert Pandits</h2>
        <p class="section-subtitle">{{ $setting->blog_6 ?? 'Our verified and experienced Pandits ensure authentic rituals and spiritual guidance.' }}</p>

        @if($pandits->count())
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($pandits as $pandit)
                <div class="bg-amber-50 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 text-center p-6">
                    @if($pandit->image)
                        <img src="{{ asset('storage/' . $pandit->image) }}" alt="{{ $pandit->name }}"
                            class="w-28 h-28 mx-auto rounded-full shadow-md object-cover mb-4">
                    @else
                        <img src="https://placehold.co/120x120/FF6D2E/FFF?text=P" alt="Pandit"
                            class="w-28 h-28 mx-auto rounded-full shadow-md object-cover mb-4">
                    @endif

                    <h3 class="text-xl font-semibold font-laila text-brand-maroon">{{ $pandit->name }}</h3>
                    <p class="text-gray-600 text-sm mt-2">{{ $pandit->bio }}</p>

                    <div class="flex justify-center space-x-4 mt-4">
                        @if($pandit->facebook)
                            <a href="{{ $pandit->facebook }}" target="_blank" class="text-blue-600 hover:opacity-75"><i data-lucide="facebook"></i></a>
                        @endif
                        @if($pandit->instagram)
                            <a href="{{ $pandit->instagram }}" target="_blank" class="text-pink-500 hover:opacity-75"><i data-lucide="instagram"></i></a>
                        @endif
                        @if($pandit->twitter)
                            <a href="{{ $pandit->twitter }}" target="_blank" class="text-blue-400 hover:opacity-75"><i data-lucide="twitter"></i></a>
                        @endif
                        @if($pandit->youtube)
                            <a href="{{ $pandit->youtube }}" target="_blank" class="text-red-600 hover:opacity-75"><i data-lucide="youtube"></i></a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-center mt-6 text-gray-500">No pandits available at the moment.</p>
        @endif
    </div>
</section>
