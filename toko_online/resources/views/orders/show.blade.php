@extends('layout')
@section('content')
<h3>Detail Pesanan {{ $order->id_order }}</h3>
<p class="mb-1">Tanggal: {{ $order->tanggal_order->format('d-m-Y H:i') }}</p>
<p>Alamat: {{ $order->alamat_pengiriman }}</p>

<table class="table table-bordered bg-white">
    <thead class="table-dark"><tr><th>Barang</th><th>Harga Satuan</th><th>Jumlah</th><th>Subtotal</th></tr></thead>
    <tbody>
    @foreach ($details as $d)
        <tr>
            <td>{{ $d->nama_barang }}</td>
            <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
            <td>{{ $d->jumlah_beli }}</td>
            <td>Rp {{ number_format($d->harga_satuan * $d->jumlah_beli, 0, ',', '.') }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot><tr><th colspan="3" class="text-end">Total Bayar</th>
        <th>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</th></tr></tfoot>
</table>
<a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
@endsection