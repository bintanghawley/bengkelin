<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-3">Dashboard Admin</h1>
    <p class="mb-4">Selamat datang Admin</p>

    <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Landing Page</a>
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
</body>
</html>