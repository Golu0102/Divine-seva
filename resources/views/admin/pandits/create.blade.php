@extends('admin.layouts.master')

@section('title', 'Add Pandit')
@section('page-title', 'Add New Pandit')

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{ route('pandits.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label>Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="col-12">
                    <label>Bio</label>
                    <textarea name="bio" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-md-6">
                    <label>Facebook</label>
                    <input type="url" name="facebook" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Instagram</label>
                    <input type="url" name="instagram" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Twitter</label>
                    <input type="url" name="twitter" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>YouTube</label>
                    <input type="url" name="youtube" class="form-control">
                </div>

                <div class="col-12 text-end mt-3">
                    <button class="btn btn-primary">Save Pandit</button>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
