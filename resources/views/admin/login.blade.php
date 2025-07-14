<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap + NiceAdmin CSS -->
  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">

  <style>
    body {
      background: #f6f9ff;
      font-family: 'Poppins', sans-serif;
    }

    .login-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      width: 100%;
      max-width: 420px;
      border-radius: 12px;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #4154f1;
    }

    .login-header {
      font-weight: 600;
      color: #4154f1;
    }

    .logo-img {
      width: 80px;
      height: 80px;
      object-fit: contain;
    }

    .input-group-text {
      cursor: pointer;
    }
  </style>
</head>

<body>
  <main>
    <div class="login-wrapper">
      <div class="card login-card p-4">
        <div class="text-center mb-3">
          <img src="{{ asset('assets/admin/img/logo.png') }}" alt="Admin Logo" class="logo-img mb-2">
          <h4 class="login-header">🔐 Admin Login</h4>
        </div>

        {{-- Alert on error --}}
        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
          @csrf

          <div class="mb-3">
            <label for="username" class="form-label">👤 Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">🔒 Password</label>
            <div class="input-group">
              <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
              <span class="input-group-text" id="togglePassword">
                <i class="bi bi-eye-slash" id="eyeIcon"></i>
              </span>
            </div>
          </div>

          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember">
              <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <a href="{{ route('admin.password.request') }}" class="text-decoration-none">Forgot Password?</a>
          </div>

          <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>

        </form>
      </div>
    </div>
  </main>

  <!-- JS -->
  <script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    // Toggle show/hide password
    document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      eyeIcon.classList.toggle('bi-eye');
      eyeIcon.classList.toggle('bi-eye-slash');
    });
  </script>
</body>

</html>
