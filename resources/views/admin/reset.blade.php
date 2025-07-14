<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
</head>

<body style="background:#f6f9ff;">
  <div class="container py-5 d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 420px;">
      <h4 class="text-center text-primary mb-4">🔒 Reset Password</h4>

      @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3">
          <label>New Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-3">
          <label>Confirm Password</label>
          <input type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Reset Password</button>
      </form>
    </div>
  </div>
</body>

</html>
