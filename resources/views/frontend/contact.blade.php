@extends('frontend.layouts.frontend')

@section('title', 'Contact Us')

@section('content')
<h2>Contact Us</h2>

<form action="{{ route('contact.submit') }}" method="POST" style="max-width: 500px;">
    @csrf

    <div class="mb-3">
        <label>Your Name</label>
        <input type="text" name="name" required class="form-control">
    </div>

    <div class="mb-3">
        <label>Email Address</label>
        <input type="email" name="email" required class="form-control">
    </div>

    <div class="mb-3">
        <label>Message</label>
        <textarea name="message" rows="4" required class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">Send Message</button>
</form>
@endsection
