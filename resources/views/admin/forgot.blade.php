<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
  <style>
    body {
      background: #f6f9ff;
    }

    .auth-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .auth-card {
      max-width: 420px;
      width: 100%;
      padding: 30px;
      border-radius: 12px;
      background: #fff;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body>
  <div class="auth-wrapper">
    <div class="auth-card">
      <h4 class="text-center mb-3 text-primary">🔑 Forgot Password</h4>

      @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('admin.password.email') }}">
        @csrf
        <div class="mb-3">
          <label for="email">📧 Email</label>
          <input type="email" class="form-control" name="email" required placeholder="Enter your email">
        </div>

        <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>

        <div class="mt-3 text-center">
          <a href="{{ route('admin.login') }}">🔙 Back to Login</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
