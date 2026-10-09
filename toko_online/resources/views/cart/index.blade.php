@extends('layout')
@section('content')
<h3 class="mb-3">Keranjang Belanja</h3>

@if ($items->isEmpty())
    <div class="alert alert-info">Keranjang kosong. <a href="{{ route('products.index') }}">Belanja dulu</a></div>
@else
<table class="table table-bordered bg-white align-middle">
    <thead class="table-dark">
        <tr><th>Barang</th><th>Harga</th><th style="width:200px">Jumlah</th><th>Subtotal</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    @foreach ($items as $i)
        <tr>
            <td>{{ $i->nama_barang }} <small class="text-muted">(stok {{ $i->stok }})</small></td>
            <td>Rp {{ number_format($i->harga, 0, ',', '.') }}</td>
            <td>
                <form method="POST" action="{{ route('cart.update', $i->id_barang) }}" class="d-flex gap-1">@csrf
                    <input type="number" name="jumlah" value="{{ $i->jumlah }}" min="1" max="{{ $i->stok }}" class="form-control form-control-sm">
                    <button class="btn btn-sm btn-outline-primary">Ubah</button>
                </form>
            </td>
            <td>Rp {{ number_format($i->harga * $i->jumlah, 0, ',', '.') }}</td>
            <td>
                <form method="POST" action="{{ route('cart.delete', $i->id_barang) }}">@csrf
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr><th colspan="3" class="text-end">Total</th>
            <th colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</th></tr>
    </tfoot>
</table>

<form method="POST" action="{{ route('checkout') }}" class="card card-body shadow-sm">@csrf
    <label class="form-label">Alamat Pengiriman</label>
    <textarea name="alamat_pengiriman" class="form-control mb-3" rows="3" required>{{ old('alamat_pengiriman', Auth::user()->alamat) }}</textarea>
    <button class="btn btn-success">Checkout</button>
</form>
@endif
@endsection