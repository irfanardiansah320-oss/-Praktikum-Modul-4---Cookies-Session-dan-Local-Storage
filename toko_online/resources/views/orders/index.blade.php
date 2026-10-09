@extends('layout')
@section('content')
<h3 class="mb-3">Riwayat Pesanan</h3>
@if ($orders->isEmpty())
    <div class="alert alert-info">Belum ada pesanan.</div>
@else
<table class="table table-bordered bg-white">
    <thead class="table-dark"><tr><th>ID Order</th><th>Tanggal</th><th>Total</th><th>Aksi</th></tr></thead>
    <tbody>
    @foreach ($orders as $o)
        <tr>
            <td>{{ $o->id_order }}</td>
            <td>{{ $o->tanggal_order->format('d-m-Y H:i') }}</td>
            <td>Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
            <td><a href="{{ route('orders.show', $o->id_order) }}" class="btn btn-sm btn-primary">Detail</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
@endif
@endsection