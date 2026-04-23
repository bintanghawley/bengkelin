<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkelin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h1 class="mb-3">Bengkelin</h1>
    <p class="mb-4">Aplikasi sederhana untuk manajemen user bengkel.</p>

    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    <a href="{{ route('register') }}" class="btn btn-success">Daftar</a>

    @if (session('user_role') === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Dashboard Admin</a>
    @endif

    @if (session('user_id'))
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @endif
</div>
</body>
</html>