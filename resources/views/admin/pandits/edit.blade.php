@extends('admin.layouts.master')
@section('title', 'Edit Pandit')
@section('page-title', 'Edit Pandit')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('pandits.update', $pandit->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $pandit->name) }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label>Experience</label>
                <input type="text" name="experience" class="form-control" value="{{ old('experience', $pandit->experience) }}">
                @error('experience') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label>Bio</label>
                <textarea name="bio" class="form-control" rows="3">{{ old('bio', $pandit->bio) }}</textarea>
                @error('bio') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                @error('image') <small class="text-danger">{{ $message }}</small> @enderror

                @if($pandit->image)
                <div class="mt-2">
                    <strong>Current Image:</strong><br>
                    <img src="{{ asset('storage/' . $pandit->image) }}" id="preview" alt="Pandit Image" style="max-height: 150px;" class="img-thumbnail">
                </div>
                @else
                <div class="mt-2">
                    <img id="preview" style="max-height: 150px; display: none;" class="img-thumbnail" />
                </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('pandits.index') }}" class="btn btn-secondary">Cancel</a>

        </div>
    </div>
</form>

@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';
    }
</script>
@endsection
