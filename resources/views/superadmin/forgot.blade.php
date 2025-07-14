<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Forgot Password | Superadmin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
</head>
<body>

<main>
  <div class="container">
    <div class="col-md-4 mx-auto mt-5">
      <div class="card p-4 shadow-sm">
        <h4 class="text-center mb-3">Forgot Password</h4>

        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('superadmin.password.email') }}">
          @csrf

          <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" required autofocus>
          </div>

          <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>

          <div class="mt-3 text-center">
            <a href="{{ route('superadmin.login') }}">Back to Login</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

</body>
</html>
