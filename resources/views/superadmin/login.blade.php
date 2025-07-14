<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Superadmin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS -->
  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">

  <style>
    body {
        background: #f6f9ff;
    }
    .login-card {
        max-width: 400px;
        margin: auto;
        margin-top: 80px;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.05);
    }
    .logo-img {
        height: 60px;
        margin-bottom: 20px;
    }
    .form-check-label {
        user-select: none;
    }
  </style>
</head>
<body>

  <main>
    <div class="container">
      <div class="login-card text-center">

        <!-- Logo -->
        <img src="{{ asset('assets/admin/img/logo.png') }}" alt="Logo" class="logo-img">

        <h4 class="mb-3">Superadmin Login</h4>

        <!-- Errors -->
        @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <!-- Success -->
        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('superadmin.login') }}">
          @csrf

          <div class="mb-3 text-start">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
          </div>

          <div class="mb-3 text-start">
            <label class="form-label">Password</label>
            <div class="input-group">
              <input type="password" name="password" class="form-control" id="passwordInput" required>
              <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                <i class="bi bi-eye" id="toggleIcon"></i>
              </button>
            </div>
          </div>

          <div class="mb-3 form-check text-start">
            <input type="checkbox" class="form-check-input" name="remember" id="rememberCheck">
            <label class="form-check-label" for="rememberCheck">Remember Me</label>
          </div>

          <button type="submit" class="btn btn-primary w-100">Login</button>

          <div class="mt-3">
            <a href="{{ route('superadmin.password.request') }}">Forgot Password?</a>
          </div>

        </form>
      </div>
    </div>
  </main>

  <!-- Scripts -->
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('passwordInput');
      const toggleIcon = document.getElementById('toggleIcon');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
      }
    }
  </script>
</body>
</html>
