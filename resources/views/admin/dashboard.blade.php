@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    <style>
        .info-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .info-card:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 2.2rem;
            margin-right: 15px;
        }
    </style>

    <div class="row">
        <!-- Total Poojas -->
        <div class="col-lg-4">
            <div class="card info-card text-white bg-primary">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title text-white">Total Poojas</h5>
                        <h3 class="mb-0"><span class="counter" data-target="{{ $totalPoojas }}">0</span></h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-bookmark-star-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="col-lg-4">
            <div class="card info-card text-white bg-success">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title text-white">Total Bookings</h5>
                        {{-- <h3 class="mb-0">{{ $totalBookings }}</h3> --}}
                        <h3 class="mb-0"><span class="counter" data-target="{{ $totalPoojas }}">0</span></h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-lg-4">
            <div class="card info-card text-white bg-warning">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title text-white">Total Revenue</h5>
                        <h3 class="mb-0">₹{{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                    <div class="card-icon">
                        <i class="bi bi-currency-rupee"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mt-4">
        <!-- Line Chart -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">📈 Bookings in Last 7 Days</h5>
                    <div id="lineChart"></div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">🛕 Pooja Wise Bookings</h5>
                    <div id="pieChart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Bookings Table -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">📋 Latest Bookings</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Pooja</th>
                                    <th>Pooja Date</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Booking Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestBookings as $index => $booking)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        {{-- Customer info from booking table --}}
                                        <td>{{ $booking->name ?? 'N/A' }}</td>

                                        {{-- Pooja name from pooja relationship --}}
                                        <td>{{ $booking->pooja->name ?? 'N/A' }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($booking->date)->format('d M, Y') }}
                                            at
                                            {{ \Carbon\Carbon::parse($booking->time)->format('h:i A') }}
                                        </td>
                                        <td>
                                            @php
                                                $badgeClass = match ($booking->status) {
                                                    'Pending' => 'warning',
                                                    'Confirmed' => 'success',
                                                    'Cancelled' => 'danger',
                                                    default => 'secondary',
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $badgeClass }}">{{ $booking->status }}</span>
                                        </td>

                                        <td>₹{{ number_format($booking->amount, 2) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M, Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No recent bookings found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <div class="text-end mt-3">
                                <a href="{{ route('admin.bookings') }}" class="btn btn-outline-primary">
                                    👁️ View All Bookings
                                </a>
                            </div>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection

@push('scripts')
    <script>
        var optionsLine = {
            series: [{
                name: 'Bookings',
                data: {!! json_encode($chartCounts) !!}
            }],
            chart: {
                height: 250,
                type: 'line',
                toolbar: {
                    show: false
                }
            },
            xaxis: {
                categories: {!! json_encode($chartDates) !!}
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: ['#0d6efd'],
            markers: {
                size: 5,
                colors: ['#0d6efd'],
                strokeColors: '#fff',
                strokeWidth: 2
            }
        };
        new ApexCharts(document.querySelector("#lineChart"), optionsLine).render();

        var optionsPie = {
            series: {!! json_encode($poojaStats->pluck('count')) !!},
            chart: {
                type: 'pie',
                height: 250
            },
            labels: {!! json_encode($poojaStats->pluck('label')) !!},
            colors: ['#0dcaf0', '#ffc107', '#198754', '#6610f2', '#fd7e14']
        };
        new ApexCharts(document.querySelector("#pieChart"), optionsPie).render();
    </script>
    <script>
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / 200;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 10);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    </script>
@endpush
