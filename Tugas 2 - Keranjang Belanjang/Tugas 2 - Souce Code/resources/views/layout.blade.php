<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Tulis</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 30px auto; }
        header { display: flex; justify-content: space-between; align-items: center;
                 border-bottom: 2px solid #333; padding-bottom: 10px; }
        .row { display: flex; justify-content: space-between; align-items: center;
               padding: 10px 0; border-bottom: 1px solid #ddd; }
        .img { width: 50px; height: 50px; background: #ccc; margin-right: 12px; }
        .left { display: flex; align-items: center; }
        .qty { display: flex; align-items: center; gap: 6px; }
        button { padding: 5px 10px; cursor: pointer; }
        a.btn { padding: 6px 12px; border: 1px solid #333; text-decoration: none; color: #000; }
    </style>
</head>
<body>
    <header>
        <h2>Toko Alat Tulis</h2>
        <a class="btn" href="{{ route('keranjang') }}">Keranjang ({{ $jumlahKeranjang }})</a>
    </header>
    @yield('isi')
</body>
</html>