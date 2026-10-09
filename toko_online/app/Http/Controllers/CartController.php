<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $items = DB::table('carts')
            ->join('products', 'carts.id_barang', '=', 'products.id_barang')
            ->where('carts.id_user', Auth::id())
            ->select('products.id_barang', 'products.nama_barang', 'products.harga',
                     'products.stok', 'products.gambar', 'carts.jumlah')
            ->get();

        $total = $items->sum(fn ($i) => $i->harga * $i->jumlah);

        return view('cart.index', compact('items', 'total'));
    }

    public function add($id)
    {
        $p = Product::findOrFail($id);
        if ($p->stok < 1) {
            return back()->with('error', 'Stok barang habis.');
        }

        $q = DB::table('carts')->where('id_user', Auth::id())->where('id_barang', $id);
        $row = $q->first();

        if ($row) {
            if ($row->jumlah + 1 > $p->stok) {
                return back()->with('error', 'Jumlah di keranjang sudah mencapai stok.');
            }
            $q->increment('jumlah');
        } else {
            DB::table('carts')->insert([
                'id_user' => Auth::id(), 'id_barang' => $id, 'jumlah' => 1,
            ]);
        }
        return back()->with('success', $p->nama_barang . ' masuk keranjang.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['jumlah' => 'required|integer|min:1']);
        $p = Product::findOrFail($id);

        if ($request->jumlah > $p->stok) {
            return back()->with('error', "Jumlah melebihi stok (maks {$p->stok}).");
        }

        DB::table('carts')->where('id_user', Auth::id())->where('id_barang', $id)
            ->update(['jumlah' => $request->jumlah]);
        return back()->with('success', 'Jumlah diperbarui.');
    }

    public function delete($id)
    {
        DB::table('carts')->where('id_user', Auth::id())->where('id_barang', $id)->delete();
        return back()->with('success', 'Barang dihapus dari keranjang.');
    }
}