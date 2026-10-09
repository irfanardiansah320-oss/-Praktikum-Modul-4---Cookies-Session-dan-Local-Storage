<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate(['alamat_pengiriman' => 'required']);

        $items = DB::table('carts')->where('id_user', Auth::id())->get();
        if ($items->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        $idOrder = 'ORD' . strtoupper(Str::random(10));

        try {
            DB::transaction(function () use ($items, $idOrder, $request) {
                $total = 0;
                $products = [];

                // 1) kunci baris barang & cek stok
                foreach ($items as $i) {
                    $p = Product::lockForUpdate()->find($i->id_barang);
                    if (!$p || $p->stok < $i->jumlah) {
                        throw new \Exception('Stok ' . ($p->nama_barang ?? $i->id_barang) . ' tidak mencukupi.');
                    }
                    $products[$i->id_barang] = $p;
                    $total += $p->harga * $i->jumlah;
                }

                // 2) buat pesanan
                DB::table('orders')->insert([
                    'id_order' => $idOrder,
                    'id_user' => Auth::id(),
                    'tanggal_order' => now(),
                    'total_harga' => $total,
                    'alamat_pengiriman' => $request->alamat_pengiriman,
                ]);

                // 3) detail pesanan + kurangi stok
                foreach ($items as $i) {
                    $p = $products[$i->id_barang];
                    DB::table('order_details')->insert([
                        'id_order' => $idOrder,
                        'id_barang' => $i->id_barang,
                        'harga_satuan' => $p->harga,
                        'jumlah_beli' => $i->jumlah,
                    ]);
                    $p->decrement('stok', $i->jumlah);
                }

                // 4) kosongkan keranjang
                DB::table('carts')->where('id_user', Auth::id())->delete();
            });
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        return redirect()->route('orders.show', $idOrder)->with('success', 'Checkout berhasil!');
    }

    public function index()
    {
        $orders = Order::where('id_user', Auth::id())->orderByDesc('tanggal_order')->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id_order', $id)->where('id_user', Auth::id())->firstOrFail();

        $details = DB::table('order_details')
            ->join('products', 'order_details.id_barang', '=', 'products.id_barang')
            ->where('order_details.id_order', $id)
            ->select('products.nama_barang', 'order_details.harga_satuan', 'order_details.jumlah_beli')
            ->get();

        return view('orders.show', compact('order', 'details'));
    }
}