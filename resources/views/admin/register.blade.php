<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
</head>

<body style="background:#f6f9ff;">
  <div class="container py-5 d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">
      <h4 class="text-center text-primary mb-3">👤 Register Admin</h4>

      @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('admin.register') }}">
        @csrf

        <div class="mb-3">
          <label>Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Confirm Password</label>
          <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>
      </form>
    </div>
  </div>
</body>

</html>
