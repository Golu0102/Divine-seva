<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Pooja Booking</title>
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Header -->
    <header style="padding: 20px; background-color: #f5f5f5; text-align: center;">
        <h1><a href="{{ url('/') }}">🛕 Pooja Booking</a></h1>
        <nav>
            <a href="/">Home</a> |
            <a href="{{ route('services') }}">Services</a> |
            <a href="{{ route('contact') }}">Contact</a>
        </nav>

    </header>

    <!-- Main Content -->
    <main style="padding: 40px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="text-align:center; padding: 20px; background-color: #eee;">
        &copy; {{ date('Y') }} Pooja Booking. All rights reserved.
    </footer>

</body>

</html>
