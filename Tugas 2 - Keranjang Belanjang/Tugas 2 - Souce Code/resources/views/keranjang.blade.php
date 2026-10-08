@extends('layout')

@section('isi')
    <h3>Keranjang belanja Tanpa login</h3>
    <p><a href="{{ route('index') }}">&larr; Kembali ke daftar barang</a></p>

    @forelse ($items as $i)
        <div class="row">
            <div>
                <strong>{{ $i['nama'] }}</strong><br>
                Rp {{ number_format($i['harga'], 0, ',', '.') }} x {{ $i['qty'] }}
                = Rp {{ number_format($i['subtotal'], 0, ',', '.') }}
            </div>
            <div class="qty">
                <form method="POST" action="{{ route('kurangQty', $i['id']) }}">@csrf<button>-</button></form>
                <span>{{ $i['qty'] }}</span>
                <form method="POST" action="{{ route('tambahQty', $i['id']) }}">@csrf<button>+</button></form>
                <form method="POST" action="{{ route('hapus', $i['id']) }}">@csrf<button>hps</button></form>
            </div>
        </div>
    @empty
        <p>Keranjang kosong.</p>
    @endforelse

    <h3>Total Rp {{ number_format($total, 0, ',', '.') }}</h3>

    @if (count($items) > 0)
        <form method="POST" action="{{ route('kosongkan') }}">
            @csrf
            <button type="submit">Kosongkan keranjang</button>
        </form>
    @endif
@endsection