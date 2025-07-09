@extends('frontend.layouts.frontend')

@section('title', $pooja->name)

@section('content')
<div class="container py-4">
    <div class="card mb-4">
        @if ($pooja->image)
            <img src="{{ asset('storage/' . $pooja->image) }}" class="card-img-top"
                style="max-height: 300px; object-fit: cover;">
        @endif
        <div class="card-body">
            <h2>{{ $pooja->name }}</h2>
            <p>{{ $pooja->description }}</p>
            <h4 class="text-success">₹{{ number_format($pooja->price, 2) }}</h4>
        </div>
    </div>

    @if($pooja->pandit)
    <div class="card mb-4 border-info shadow-sm">
        <div class="card-body d-flex align-items-center">
            @if ($pooja->pandit->image)
                <img src="{{ asset('storage/' . $pooja->pandit->image) }}" class="rounded" 
                     style="width:100px; height:100px; object-fit:cover; margin-right: 20px;">
            @endif
            <div>
                <h5 class="text-primary mb-1">Pandit: {{ $pooja->pandit->name }}</h5>
                <p class="mb-0"><strong>Experience:</strong> {{ $pooja->pandit->experience }} years</p>
                <p class="mb-0"><strong>Bio:</strong> {{ $pooja->pandit->bio }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">📅 Book This Pooja</h4>

            <form action="{{ route('book.pooja') }}" method="POST">
                @csrf
                <input type="hidden" name="pooja_id" value="{{ $pooja->id }}">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" name="mobile" class="form-control" placeholder="10-digit mobile" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Your full address" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Pooja Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Pooja Time</label>
                        <input type="time" name="time" class="form-control" required>
                    </div>

                    <div class="col-12 text-end">
                        <button class="btn btn-success mt-3">✅ Confirm Booking</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
