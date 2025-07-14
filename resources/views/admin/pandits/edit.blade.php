@extends('admin.layouts.master')

@section('title', 'Edit Pandit')
@section('page-title', 'Edit Pandit')

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{ route('pandits.update', $pandit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label>Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ $pandit->name }}" required>
                </div>

                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $pandit->email }}">
                </div>

                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $pandit->phone }}">
                </div>

                <div class="col-md-6">
                    <label>Current Image</label><br>
                    @if($pandit->image)
                        <img src="{{ asset('storage/' . $pandit->image) }}" width="100" class="mb-2">
                    @else
                        <small>No image</small>
                    @endif
                    <input type="file" name="image" class="form-control mt-2">
                </div>

                <div class="col-12">
                    <label>Bio</label>
                    <textarea name="bio" class="form-control" rows="3">{{ $pandit->bio }}</textarea>
                </div>

                <div class="col-md-6">
                    <label>Facebook</label>
                    <input type="url" name="facebook" class="form-control" value="{{ $pandit->facebook }}">
                </div>

                <div class="col-md-6">
                    <label>Instagram</label>
                    <input type="url" name="instagram" class="form-control" value="{{ $pandit->instagram }}">
                </div>

                <div class="col-md-6">
                    <label>Twitter</label>
                    <input type="url" name="twitter" class="form-control" value="{{ $pandit->twitter }}">
                </div>

                <div class="col-md-6">
                    <label>YouTube</label>
                    <input type="url" name="youtube" class="form-control" value="{{ $pandit->youtube }}">
                </div>

                <div class="col-12 text-end mt-3">
                    <button class="btn btn-success">Update Pandit</button>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
