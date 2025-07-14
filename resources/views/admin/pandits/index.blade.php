@extends('admin.layouts.master')

@section('title', 'Pandits')
@section('page-title', 'All Pandits')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4>Pandit List</h4>
    <a href="{{ route('pandits.create') }}" class="btn btn-primary">+ Add Pandit</a>
</div>

<div class="card">
    <div class="card-body">
        @if($pandits->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Socials</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pandits as $index => $pandit)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($pandit->image)
                            <img src="{{ asset('storage/' . $pandit->image) }}" width="60" class="rounded-circle" />
                        @else
                            <small>No Image</small>
                        @endif
                    </td>
                    <td>{{ $pandit->name }}</td>
                    <td>{{ $pandit->email }}</td>
                    <td>{{ $pandit->phone }}</td>
                    <td>
                        @if($pandit->facebook)
                            <a href="{{ $pandit->facebook }}" target="_blank"><i class="bi bi-facebook text-primary me-1"></i></a>
                        @endif
                        @if($pandit->instagram)
                            <a href="{{ $pandit->instagram }}" target="_blank"><i class="bi bi-instagram text-danger me-1"></i></a>
                        @endif
                        @if($pandit->twitter)
                            <a href="{{ $pandit->twitter }}" target="_blank"><i class="bi bi-twitter text-info me-1"></i></a>
                        @endif
                        @if($pandit->youtube)
                            <a href="{{ $pandit->youtube }}" target="_blank"><i class="bi bi-youtube text-danger me-1"></i></a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('pandits.edit', $pandit->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pandits.destroy', $pandit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this pandit?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-muted">No pandits found.</p>
        @endif
    </div>
</div>

@endsection
