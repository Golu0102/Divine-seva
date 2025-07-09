@extends('admin.layouts.master')

@section('title', 'Manage Poojas')
@section('page-title', 'Pooja List')

@section('content')
<div class="mb-3 text-end">
    <a href="{{ route('poojas.create') }}" class="btn btn-primary">+ New Pooja</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Pooja Name</th>
                    <th>Price (₹)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($poojas as $pooja)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($pooja->image)
                                <img src="{{ asset('storage/' . $pooja->image) }}" alt="Pooja Image" style="height: 60px;" class="img-thumbnail">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>{{ $pooja->name }}</td>
                        <td>{{ $pooja->price }}</td>
                        <td>
                            <a href="{{ route('poojas.edit', $pooja) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('poojas.destroy', $pooja) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">No poojas found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $poojas->links() }}
        </div>
    </div>
</div>
@endsection
