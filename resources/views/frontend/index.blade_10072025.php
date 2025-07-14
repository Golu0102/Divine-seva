@extends('frontend.layouts.frontend')

@section('title', 'Home')

@section('content')
<h2>Available Poojas</h2>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
    @forelse ($poojas as $pooja)
    <div class="card">
        @if ($pooja->image)
        <img src="{{ asset('storage/' . $pooja->image) }}" style="width:100%; height:180px; object-fit:cover;">
        @endif
        <h3>{{ $pooja->name }}</h3>
        <p>{{ Str::limit($pooja->description, 100) }}</p>
        <strong>₹{{ number_format($pooja->price, 2) }}</strong>
        <br>
        <a href="{{ url('/pooja/' . $pooja->id) }}" class="btn">Book Now</a>
    </div>
    @empty
    <p>No poojas available right now.</p>
    @endforelse
</div>
@endsection
