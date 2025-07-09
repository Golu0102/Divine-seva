<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Admin</title>
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
            <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">Admin Panel</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item pe-3">
                    <a class="nav-link nav-icon" href="{{ route('admin.logout') }}" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? '' : 'collapsed' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- Pandits -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/pandits*') ? '' : 'collapsed' }}"
                    href="{{ route('pandits.index') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Pandits</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('poojas.index') }}">
                    <i class="bi bi-journal-bookmark"></i>
                    <span>Poojas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.bookings') }}">
                    <i class="bi bi-card-checklist"></i>
                    <span>Bookings</span>
                </a>
            </li>
        </ul>
    </aside>

    <main id="main" class="main">
        @yield('content')
    </main>

    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; {{ date('Y') }} <strong>Pooja Booking Admin</strong>. All Rights Reserved
        </div>
    </footer>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @stack('scripts')
</body>

</html>
