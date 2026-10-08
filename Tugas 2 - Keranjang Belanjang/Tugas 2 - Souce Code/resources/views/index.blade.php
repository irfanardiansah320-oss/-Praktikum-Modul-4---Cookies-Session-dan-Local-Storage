@extends('layout')

@section('isi')
    <h3>Daftar barang</h3>
    @foreach ($barang as $b)
        <div class="row">
            <div class="left">
                <div class="img"></div>
                <div>{{ $b->nama }} &nbsp; Rp {{ number_format($b->harga, 0, ',', '.') }}
                    <small>(stok: {{ $b->stok }})</small>
                </div>
            </div>
            <form method="POST" action="{{ route('tambah', $b->id) }}">
                @csrf
                <button type="submit">Masukkan ke keranjang</button>
            </form>
        </div>
    @endforeach
@endsection