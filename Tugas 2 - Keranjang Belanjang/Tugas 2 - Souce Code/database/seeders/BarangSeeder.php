<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::insert([
            ['nama' => 'Buku Tulis', 'harga' => 5000, 'stok' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pulpen',     'harga' => 3000, 'stok' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Penggaris',  'harga' => 4000, 'stok' => 40, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pensil 2B',  'harga' => 2500, 'stok' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Penghapus',  'harga' => 1500, 'stok' => 60, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}