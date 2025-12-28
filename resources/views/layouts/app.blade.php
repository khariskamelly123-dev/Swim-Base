<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Swim Base</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('athlete.index') }}">SwimBase</a>
    <div>
      <a class="btn btn-outline-primary btn-sm" href="{{ route('athlete.index') }}">Data Atlet</a>
      <a class="btn btn-outline-secondary btn-sm" href="{{ route('submission.index') }}">Pengajuan</a>
      <form action="{{ route('logout') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="dropdown-item">
        Logout
    </button>
    </form>
    </div>
  </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>


