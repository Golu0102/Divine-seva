@extends('admin.layouts.master')
@section('title', 'Add Pandit')
@section('page-title', 'Create Pandit')

@section('content')
<form action="{{ route('pandits.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Experience</label>
                <input type="text" name="experience" class="form-control">
            </div>

            <div class="mb-3">
                <label>Bio</label>
                <textarea name="bio" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('pandits.index') }}" class="btn btn-secondary">Back</a>

        </div>
    </div>
</form>
@endsection
