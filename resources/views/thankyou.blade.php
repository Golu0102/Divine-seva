@extends('frontend.layouts.frontend')

@section('title', 'Thank You')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-amber-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl text-center bg-white rounded-xl shadow-xl p-10">
        <div class="flex justify-center mb-6">
            <img src="https://img.icons8.com/color/96/ok--v1.png" class="h-20 mx-auto mb-6" alt="Success Icon" />
        </div>

        <h2 class="text-3xl font-laila text-brand-maroon font-bold mb-4">Thank You for Booking! 🙏</h2>
        <p class="text-gray-600 text-lg mb-6">Your pooja booking has been received. We will contact you shortly with further details.</p>

        <a href="{{ url('/') }}"
           class="inline-block bg-brand-orange text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-opacity-90 hover:scale-105 transition-all duration-300">
            🔙 Back to Home
        </a>
    </div>
</div>
@endsection
