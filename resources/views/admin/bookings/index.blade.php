@extends('admin.layouts.master')

@section('title', 'All Bookings')
@section('page-title', 'Booking List')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pooja</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $index => $booking)
                <tr>
                    <td>{{ $bookings->firstItem() + $index }}</td>
                    <td>{{ $booking->pooja->name ?? '-' }}</td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->mobile }}</td>
                    <td>{{ $booking->address }}</td>
                    <td>{{ $booking->date }} {{ $booking->time }}</td>
                    <td><span class="badge bg-info">{{ $booking->status }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.bookings.status', $booking->id) }}">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                @foreach(['Pending','Confirmed','Completed'] as $status)
                                    <option value="{{ $status }}" {{ $booking->status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center">No bookings found.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $bookings->links() }}
    </div>
</div>
@endsection
