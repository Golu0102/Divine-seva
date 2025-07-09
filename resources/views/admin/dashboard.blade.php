@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    <div class="row">
        <!-- Total Poojas -->
        <div class="col-lg-4">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Total Poojas</h5>
                    <h6>{{ $totalPoojas }}</h6>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="col-lg-4">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Total Bookings</h5>
                    <h6>{{ $totalBookings }}</h6>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-lg-4">
            <div class="card info-card">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <h6>₹{{ number_format($totalRevenue, 2) }}</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mt-4">
        <!-- Line Chart -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bookings in Last 7 Days</h5>
                    <div id="lineChart"></div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pooja Wise Bookings</h5>
                    <div id="pieChart"></div>
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
                curve: 'smooth'
            },
            colors: ['#4154f1']
        };
        new ApexCharts(document.querySelector("#lineChart"), optionsLine).render();

        var optionsPie = {
            series: {!! json_encode($poojaStats->pluck('count')) !!},
            chart: {
                type: 'pie',
                height: 250
            },
            labels: {!! json_encode($poojaStats->pluck('label')) !!}
        };
        new ApexCharts(document.querySelector("#pieChart"), optionsPie).render();
    </script>
@endpush
