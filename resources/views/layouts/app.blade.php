<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'Loket Tiket' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="{{ route('events.index') }}">Loket Tiket</a>
    <div class="d-flex flex-wrap gap-2">
      <a class="btn btn-outline-light btn-sm" href="{{ route('events.index') }}">Event</a>
      <a class="btn btn-outline-light btn-sm" href="{{ route('customers.index') }}">Customer</a>
      <a class="btn btn-outline-light btn-sm" href="{{ route('orders.index') }}">Transaksi</a>
      <a class="btn btn-outline-light btn-sm" href="{{ route('event-categories.index') }}">Kategori</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <div class="fw-semibold mb-1">Perbaiki dulu:</div>
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  @yield('content')
</div>
</body>
</html>
