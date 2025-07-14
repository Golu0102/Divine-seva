@extends('frontend.layouts.frontend')

@section('title', 'All Poojas')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h2 class="section-title mb-6">All Available Poojas</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse ($poojas as $pooja)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 overflow-hidden">
                @if ($pooja->image)
                    <img src="{{ asset('storage/' . $pooja->image) }}" class="w-full h-48 object-cover" alt="{{ $pooja->name }}">
                @endif
                <div class="p-5">
                    <h3 class="text-xl font-semibold text-brand-maroon">{{ $pooja->name }}</h3>
                    <p class="text-sm text-gray-600 mt-2">{{ \Illuminate\Support\Str::limit($pooja->description, 80) }}</p>
                    <div class="mt-3 flex justify-between items-center">
                        <span class="text-brand-orange font-bold">₹{{ number_format($pooja->price, 2) }}</span>
                        <a href="{{ route('pooja.view', $pooja->id) }}" class="text-brand-orange hover:underline font-medium">Book Now →</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-600">No poojas found.</p>
        @endforelse
    </div>
</div>
@endsection
