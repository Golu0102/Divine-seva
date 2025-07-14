@extends('frontend.layouts.frontend')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="relative hero-bg text-white">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-32 md:py-48 text-center">
            <h1 class="font-laila text-4xl md:text-6xl font-bold leading-tight">
                {{ $setting->blog_1 ?? 'Authentic Vedic Rituals at Your Doorstep' }}
            </h1>
            <p class="mt-6 text-lg md:text-xl max-w-3xl mx-auto text-gray-200">
                {{ $setting->blog_2 ?? 'Book experienced and verified Pandits for all your religious ceremonies. Simple, transparent, and
                hassle-free.' }}
                
            </p>
            <div class="mt-10">
                <a href="#services"
                    class="bg-brand-orange text-white font-bold text-lg px-8 py-4 rounded-lg shadow-xl hover:bg-opacity-90 transition transform hover:scale-105 duration-300">
                    Explore Poojas
                </a>
            </div>
        </div>
    </section>

    <!-- Our Pooja Services -->
    <section id="services" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="section-title">Our Pooja Services</h2>
            <p class="section-subtitle">{{ $setting->blog_3 ?? 'We offer a wide range of poojas and ceremonies performed by our learned Pandits, adhering to Vedic
                traditions.' }}
                
            </p>
            <div class="overflow-hidden mt-12">
                <div id="carousel-wrapper" class="flex space-x-4 overflow-x-auto scroll-smooth whitespace-nowrap">
                    @foreach ($poojas as $pooja)
                        <div
                            class="min-w-[300px] bg-amber-50 rounded-xl p-6 text-center shadow-lg inline-block transition-all duration-300 hover:shadow-2xl hover:border hover:border-brand-orange">
                            <div class="flex justify-center items-center h-20 w-20 rounded-full bg-brand-orange/10 mx-auto">
                                <img src="{{ asset('storage/' . $pooja->image) }}"
                                    class="rounded-full w-12 h-12 object-cover" alt="Pooja Icon">
                            </div>
                            <h3 class="font-laila text-xl font-semibold text-brand-maroon mt-6">{{ $pooja->name }}</h3>
                            <p class="mt-2 text-gray-600">{{ Str::limit($pooja->description, 100) }}</p>
                            <a href="{{ route('pooja.view', $pooja->id) }}"
                                class="text-brand-orange font-semibold mt-4 inline-block">Learn More &rarr;</a>
                        </div>
                    @endforeach
                    {{-- Duplicate --}}
                    @foreach ($poojas as $pooja)
                        <div class="min-w-[300px] bg-amber-50 rounded-xl p-6 text-center shadow-lg inline-block">
                            <div class="flex justify-center items-center h-20 w-20 rounded-full bg-brand-orange/10 mx-auto">
                                <img src="{{ asset('storage/' . $pooja->image) }}"
                                    class="rounded-full w-12 h-12 object-cover" alt="Pooja Icon">
                            </div>
                            <h3 class="font-laila text-xl font-semibold text-brand-maroon mt-6">{{ $pooja->name }}</h3>
                            <p class="mt-2 text-gray-600">{{ Str::limit($pooja->description, 100) }}</p>
                            <a href="{{ route('pooja.view', $pooja->id) }}"
                                class="text-brand-orange font-semibold mt-4 inline-block">Learn More &rarr;</a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('poojas.all') }}"
                    class="bg-brand-maroon text-white font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-opacity-90 transition duration-300">
                    View All Poojas
                </a>

            </div>
        </div>
    </section>

    <!-- Booking Process -->
    @include('frontend.sections.process')

    <!-- =========== Why Choose Us Section =========== -->
    @include('frontend.sections.why_choose')
    <!-- =========== Our Pandits Section =========== -->
    @include('frontend.sections.pandits')
    <!-- Testimonials -->
    {{-- @include('frontend.sections.testimonials') --}}
@endsection
