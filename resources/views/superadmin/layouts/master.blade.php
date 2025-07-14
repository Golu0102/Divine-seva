<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Superadmin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- NiceAdmin CSS -->
    <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('superadmin.dashboard') }}" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">Superadmin Panel</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item pe-3">
                    <form method="POST" action="{{ route('superadmin.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link nav-icon text-danger" title="Logout">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('superadmin/dashboard') ? '' : 'collapsed' }}"
                   href="{{ route('superadmin.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('superadmin/site-settings*') ? '' : 'collapsed' }}"
                   href="{{ route('superadmin.site-settings.edit') }}">
                    <i class="bi bi-gear"></i>
                    <span>Site Settings</span>
                </a>
            </li>

            {{-- Add more superadmin-only links below --}}
        </ul>
    </aside>

    <main id="main" class="main">

        {{-- ======= Page Title & Breadcrumb ======= --}}
        <div class="pagetitle">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Home</a></li>
                    @php
                        $segments = Request::segments();
                        $url = '';
                    @endphp
                    @foreach ($segments as $index => $segment)
                        @php $url .= '/' . $segment; @endphp
                        @if (is_numeric($segment) && isset($breadcrumbItem))
                            <li class="breadcrumb-item active">{{ $breadcrumbItem }}</li>
                        @elseif ($loop->last)
                            <li class="breadcrumb-item active">{{ ucfirst(str_replace('-', ' ', $segment)) }}</li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{ url($url) }}">{{ ucfirst(str_replace('-', ' ', $segment)) }}</a>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>

        {{-- ======= Flash Messages ======= --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ======= Page Content ======= --}}
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; {{ date('Y') }} <strong>Pooja Booking Superadmin</strong>. All Rights Reserved
        </div>
    </footer>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
