<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Login</title>
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
  <main>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card shadow p-4">
            <h4 class="text-center mb-3">Admin Login</h4>
            @if($errors->any())
              <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('admin.login') }}">
              @csrf
              <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
