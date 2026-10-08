<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    // Session hanya menyimpan: [id_barang => jumlah]
    private function ambil(): array
    {
        return session('keranjang', []);
    }

    private function totalItem(): int
    {
        return array_sum($this->ambil());
    }

    public function index()
    {
        $barang = Barang::all();
        $jumlahKeranjang = $this->totalItem();
        return view('index', compact('barang', 'jumlahKeranjang'));
    }

    public function tambah($id)
    {
        $barang = Barang::findOrFail($id);
        $keranjang = $this->ambil();

        $sekarang = $keranjang[$id] ?? 0;
        if ($sekarang < $barang->stok) {
            $keranjang[$id] = $sekarang + 1;
        }

        session(['keranjang' => $keranjang]);
        return redirect()->route('index');
    }

    public function keranjang()
    {
        $keranjang = $this->ambil();
        $items = [];
        $total = 0;

        // Nama & harga SELALU diambil dari database
        foreach (Barang::whereIn('id', array_keys($keranjang))->get() as $b) {
            $qty = $keranjang[$b->id];
            $subtotal = $b->harga * $qty;
            $total += $subtotal;
            $items[] = [
                'id' => $b->id,
                'nama' => $b->nama,
                'harga' => $b->harga,
                'qty' => $qty,
                'subtotal' => $subtotal,
            ];
        }

        $jumlahKeranjang = $this->totalItem();
        return view('keranjang', compact('items', 'total', 'jumlahKeranjang'));
    }

    public function tambahQty($id)
    {
        $barang = Barang::findOrFail($id);
        $keranjang = $this->ambil();

        if (isset($keranjang[$id]) && $keranjang[$id] < $barang->stok) {
            $keranjang[$id]++;
        }

        session(['keranjang' => $keranjang]);
        return redirect()->route('keranjang');
    }

    public function kurangQty($id)
    {
        $keranjang = $this->ambil();

        if (isset($keranjang[$id])) {
            $keranjang[$id]--;
            if ($keranjang[$id] <= 0) {
                unset($keranjang[$id]); // jumlah 0 -> hapus otomatis
            }
        }

        session(['keranjang' => $keranjang]);
        return redirect()->route('keranjang');
    }

    public function hapus($id)
    {
        $keranjang = $this->ambil();
        unset($keranjang[$id]);
        session(['keranjang' => $keranjang]);
        return redirect()->route('keranjang');
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return redirect()->route('keranjang');
    }
}