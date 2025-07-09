@extends('admin.layouts.master')

@section('title', 'Add New Pooja')
@section('page-title', 'Create Pooja')

@section('content')
    <form action="{{ route('poojas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-body">

                <div class="mb-3">
                    <label for="name" class="form-label">Pooja Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (₹)</label>
                    <input type="number" name="price" class="form-control" step="0.01" required
                        value="{{ old('price') }}">
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
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" accept="image/*" class="form-control"
                        onchange="previewImage(event)">
                    <div class="mt-2">
                        <img id="preview" src="#" alt="Preview" style="max-height: 150px; display:none;"
                            class="img-thumbnail">
                    </div>
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Save</button>
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
