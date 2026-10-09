@extends('layout')
@section('content')
<h3 class="mb-3">Daftar Barang</h3>
<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3">
    @foreach ($products as $p)
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="{{ asset('images/' . $p->gambar) }}" class="card-img-top"
                 style="height:180px;object-fit:cover" alt="{{ $p->nama_barang }}"
                 onerror="this.onerror=null;this.src='https://placehold.co/400x300?text={{ urlencode($p->nama_barang) }}'">
            <div class="card-body">
                <h6 class="card-title">{{ $p->nama_barang }}</h6>
                <p class="small text-muted">{{ $p->deskripsi }}</p>
                <div class="fw-bold">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                <div class="small">Stok: {{ $p->stok }}</div>
            </div>
            <div class="card-footer bg-white">
                @if ($p->stok == 0)
                    <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
                @elseif (Auth::check())
                    <form method="POST" action="{{ route('cart.add', $p->id_barang) }}">@csrf
                        <button class="btn btn-primary w-100">+ Keranjang</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">Login untuk membeli</a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection