@extends('admin.layouts.master')

@section('title', 'Edit Pooja')
@section('page-title', 'Edit Pooja')

@section('content')
    <form action="{{ route('poojas.update', $pooja->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">

                <div class="mb-3">
                    <label for="name" class="form-label">Pooja Name</label>
                    <input type="text" name="name" class="form-control" required
                        value="{{ old('name', $pooja->name) }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $pooja->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (₹)</label>
                    <input type="number" name="price" class="form-control" step="0.01" required
                        value="{{ old('price', $pooja->price) }}">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pandit_id" class="form-label">Assign Pandit</label>
                    <select name="pandit_id" class="form-control">
                        <option value="">-- Select Pandit --</option>
                        @foreach ($pandits as $pandit)
                            <option value="{{ $pandit->id }}"
                                {{ old('pandit_id', $pooja->pandit_id ?? '') == $pandit->id ? 'selected' : '' }}>
                                {{ $pandit->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('pandit_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="image" class="form-label">Image (optional)</label>
                    <input type="file" name="image" accept="image/*" class="form-control"
                        onchange="previewImage(event)">

                    @if ($pooja->image)
                        <div class="mt-2">
                            <p>Current Image:</p>
                            <img src="{{ asset('storage/' . $pooja->image) }}" alt="Current Image"
                                style="max-height: 150px;" class="img-thumbnail">
                        </div>
                    @endif

                    <div class="mt-2">
                        <p>New Preview:</p>
                        <img id="preview" src="#" alt="New Image Preview" style="max-height: 150px; display: none;"
                            class="img-thumbnail">
                    </div>

                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('poojas.index') }}" class="btn btn-secondary">Back</a>

            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        function previewImage(event) {
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.style.display = 'block';
        }
    </script>
@endsection
