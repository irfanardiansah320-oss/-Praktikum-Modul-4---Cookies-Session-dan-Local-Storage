<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('products.index') }}">Toko Online</a>
        <ul class="navbar-nav ms-auto align-items-center">
            @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Keranjang</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Riwayat Pesanan</a></li>
                <li class="nav-item"><span class="nav-link text-info">Hai, {{ Auth::user()->nama_lengkap }}</span></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">@csrf
                        <button class="btn btn-sm btn-outline-light ms-2">Logout</button>
                    </form>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Daftar</a></li>
            @endauth
        </ul>
    </div>
</nav>

<div class="container pb-5">
    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
        </div>
    @endif

    @yield('content')
</div>
</body>
</html>