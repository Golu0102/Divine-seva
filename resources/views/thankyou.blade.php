@extends('frontend.layouts.frontend')

@section('content')
<div class="container py-5 text-center">
    <h2>🎉 Thank You for Your Booking</h2>
    <p>We will contact you soon regarding the Pooja.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
</div>
@endsection
