@extends('frontend.layouts.frontend')

@section('title', 'Services')

@section('content')
<h2>Our Services</h2>

<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
    @foreach($poojas as $pooja)
    <div class="card" style="padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        @if($pooja->image)
            <img src="{{ asset('storage/' . $pooja->image) }}" style="width:100%; height:160px; object-fit:cover; border-radius: 5px;">
        @endif
        <h3>{{ $pooja->name }}</h3>
        <p>{{ Str::limit($pooja->description, 100) }}</p>
        <p><strong>₹{{ number_format($pooja->price, 2) }}</strong></p>
        <a href="{{ url('/pooja/' . $pooja->id) }}" class="btn">Book Now</a>
    </div>
    @endforeach
</div>
@endsection
