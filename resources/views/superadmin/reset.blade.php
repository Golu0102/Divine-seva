<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password | Superadmin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
</head>
<body>

<main>
  <div class="container">
    <div class="col-md-4 mx-auto mt-5">
      <div class="card p-4 shadow-sm">
        <h4 class="text-center mb-3">Reset Password</h4>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('superadmin.password.update') }}">
          @csrf

          <input type="hidden" name="token" value="{{ $token }}">
          <input type="hidden" name="email" value="{{ $email }}">

          <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-success w-100">Reset Password</button>

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
