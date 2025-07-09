@extends('admin.layouts.master')
@section('title', 'Pandits')
@section('page-title', 'Pandit List')

@section('content')
<div class="mb-3 text-end">
    <a href="{{ route('pandits.create') }}" class="btn btn-primary">+ Add Pandit</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Bio</th>
                    <th>Experience</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pandits as $pandit)
                <tr>
                    <td>
                        @if($pandit->image)
                            <img src="{{ asset('storage/' . $pandit->image) }}" width="60" height="60">
                        @endif
                    </td>
                    <td>{{ $pandit->name }}</td>
                    <td>{{ $pandit->bio }}</td>
                    <td>{{ $pandit->experience }}</td>
                    <td>
                        <a href="{{ route('pandits.edit', $pandit->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pandits.destroy', $pandit->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4">No pandits found.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">{{ $pandits->links() }}</div>
    </div>
</div>
@endsection
