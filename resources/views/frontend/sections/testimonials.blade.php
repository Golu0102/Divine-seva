<section id="testimonials" class="py-20 bg-amber-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title">Devotees Speak</h2>
        <p class="section-subtitle">Heartfelt experiences shared by our satisfied clients.</p>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($feedbacks as $feedback)
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <p class="text-gray-700 italic">
                        "{{ $feedback->comment }}"
                    </p>

                    {{-- Rating Stars --}}
                    <div class="flex mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.947h4.15c.969 0 1.371 1.24.588 1.81l-3.36 2.443 1.286 3.947c.3.921-.755 1.688-1.54 1.118L10 13.348l-3.36 2.444c-.784.57-1.838-.197-1.54-1.118l1.286-3.947-3.36-2.443c-.783-.57-.38-1.81.588-1.81h4.15l1.286-3.947z" />
                            </svg>
                        @endfor
                    </div>

                    <div class="mt-4 flex items-center">
                        <img src="https://placehold.co/48x48" class="rounded-full mr-3" alt="User">
                        <div>
                            <h4 class="font-semibold text-brand-maroon">
                                {{ $feedback->booking->name ?? 'Anonymous' }}
                            </h4>
                            <span class="text-sm text-gray-500">
                                {{ $feedback->booking->address ?? 'NA' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
