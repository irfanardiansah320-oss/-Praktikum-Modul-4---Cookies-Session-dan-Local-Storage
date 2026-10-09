<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $t) {
            $t->string('id_user', 15)->primary();
            $t->string('nama_lengkap', 100);
            $t->string('email', 100)->unique();
            $t->string('username', 50)->unique();
            $t->string('password', 255);
            $t->string('no_hp', 15)->nullable();
            $t->text('alamat')->nullable();
        });

        Schema::create('products', function (Blueprint $t) {
            $t->string('id_barang', 10)->primary();
            $t->string('nama_barang', 50);
            $t->text('deskripsi')->nullable();
            $t->decimal('harga', 12, 2);
            $t->integer('stok');
            $t->string('gambar', 255);
        });

        // tabel keranjang (tabel 4 yang hilang di soal)
        Schema::create('carts', function (Blueprint $t) {
            $t->string('id_user', 15);
            $t->string('id_barang', 10);
            $t->integer('jumlah');
            $t->primary(['id_user', 'id_barang']);
            $t->foreign('id_user')->references('id_user')->on('users')->cascadeOnDelete();
            $t->foreign('id_barang')->references('id_barang')->on('products')->cascadeOnDelete();
        });

        Schema::create('orders', function (Blueprint $t) {
            $t->string('id_order', 15)->primary();
            $t->string('id_user', 15);
            $t->dateTime('tanggal_order');
            $t->decimal('total_harga', 12, 2);
            $t->text('alamat_pengiriman');
            $t->foreign('id_user')->references('id_user')->on('users');
        });

        Schema::create('order_details', function (Blueprint $t) {
            $t->string('id_order', 15);
            $t->string('id_barang', 10);
            $t->decimal('harga_satuan', 12, 2);
            $t->integer('jumlah_beli');
            $t->primary(['id_order', 'id_barang']);
            $t->foreign('id_order')->references('id_order')->on('orders')->cascadeOnDelete();
            $t->foreign('id_barang')->references('id_barang')->on('products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('products');
        Schema::dropIfExists('users');
    }
};