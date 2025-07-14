@extends('frontend.layouts.frontend')

@section('title', $pooja->name)

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Pooja Image -->
    <div class="mb-6">
        @if ($pooja->image)
            <img src="{{ asset('storage/' . $pooja->image) }}" alt="{{ $pooja->name }}" class="w-full max-h-[400px] object-cover rounded-lg shadow-md">
        @endif
    </div>

    <!-- Pooja Info -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h1 class="font-laila text-3xl font-bold text-brand-maroon mb-4">{{ $pooja->name }}</h1>
        <p class="text-gray-700 mb-4">{{ $pooja->description }}</p>
        <h3 class="text-xl text-brand-orange font-semibold mb-6">₹{{ number_format($pooja->price, 2) }}</h3>

        @if($pooja->pandit)
        <div class="flex gap-4 items-center mb-6 bg-amber-50 p-4 rounded-xl border border-brand-orange">
            @if ($pooja->pandit->image)
                <img src="{{ asset('storage/' . $pooja->pandit->image) }}" class="w-24 h-24 rounded-full object-cover">
            @endif
            <div>
                <h4 class="text-lg font-semibold text-brand-maroon">Pandit: {{ $pooja->pandit->name }}</h4>
                <p class="text-sm text-gray-600">{{ $pooja->pandit->bio }}</p>
                <div class="flex space-x-4 mt-2">
                    @if($pooja->pandit->facebook)
                        <a href="{{ $pooja->pandit->facebook }}" target="_blank" class="text-blue-600 hover:opacity-75"><i data-lucide="facebook"></i></a>
                    @endif
                    @if($pooja->pandit->instagram)
                        <a href="{{ $pooja->pandit->instagram }}" target="_blank" class="text-pink-500 hover:opacity-75"><i data-lucide="instagram"></i></a>
                    @endif
                    @if($pooja->pandit->twitter)
                        <a href="{{ $pooja->pandit->twitter }}" target="_blank" class="text-blue-400 hover:opacity-75"><i data-lucide="twitter"></i></a>
                    @endif
                    @if($pooja->pandit->youtube)
                        <a href="{{ $pooja->pandit->youtube }}" target="_blank" class="text-red-600 hover:opacity-75"><i data-lucide="youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Booking Form -->
        <form action="{{ route('book.pooja') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="pooja_id" value="{{ $pooja->id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input name="name" type="text" class="form-input w-full p-3 border border-gray-300 rounded-lg" placeholder="Your Name" required>
                <input name="mobile" type="text" class="form-input w-full p-3 border border-gray-300 rounded-lg" placeholder="Mobile Number" required>
            </div>

            <textarea name="address" rows="3" class="form-textarea w-full p-3 border border-gray-300 rounded-lg" placeholder="Your Full Address" required></textarea>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input name="date" type="date" class="form-input w-full p-3 border border-gray-300 rounded-lg" required>
                <input name="time" type="time" class="form-input w-full p-3 border border-gray-300 rounded-lg" required>
            </div>

            <div class="text-end">
                <button class="bg-brand-orange text-white px-6 py-3 rounded-lg hover:bg-opacity-90 transition">✅ Confirm Booking</button>
            </div>
        </form>
    </div>
</div>
@endsection
