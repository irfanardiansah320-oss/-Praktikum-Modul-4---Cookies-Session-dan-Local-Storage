<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id_user' => 'USR001', 'nama_lengkap' => 'Irfan', 'email' => 'irfan@mail.com',
            'username' => 'irfan', 'password' => 'password123',
            'no_hp' => '081234567890', 'alamat' => 'Perum Bumi Tipar Silih Asih No. 34, Bandung Barat',
        ]);
        User::create([
            'id_user' => 'USR002', 'nama_lengkap' => 'Aisy Fathrayan Siswandar', 'email' => 'aisy@mail.com',
            'username' => 'aisy', 'password' => 'password123',
            'no_hp' => '081298765432', 'alamat' => 'Kalidam, Cimahi',
        ]);

        $produk = [
            ['BRG001', 'Mouse Wireless',      'Mouse wireless 2.4GHz',        85000,  25, 'mouse.jpg'],
            ['BRG002', 'Keyboard Mechanical', 'Keyboard mechanical blue switch', 350000, 10, 'keyboard.jpg'],
            ['BRG003', 'Headset Gaming',      'Headset dengan mic',           175000, 15, 'headset.jpg'],
            ['BRG004', 'Flashdisk 64GB',      'USB 3.0 kecepatan tinggi',     65000,  50, 'flashdisk.jpg'],
            ['BRG005', 'Webcam HD',           'Webcam 720p untuk meeting',    120000, 8,  'webcam.jpg'],
            ['BRG006', 'Powerbank 10000mAh',  'Powerbank fast charging',      150000, 20, 'powerbank.jpg'],
            ['BRG007', 'Kabel HDMI 2m',       'Kabel HDMI 4K',                45000,  40, 'hdmi.jpg'],
            ['BRG008', 'Laptop Stand',        'Stand laptop aluminium',       95000,  12, 'stand.jpg'],
            ['BRG009', 'Mousepad XL',         'Mousepad ukuran besar',        55000,  30, 'mousepad.jpg'],
            ['BRG010', 'Speaker Bluetooth',   'Speaker portable (stok habis)', 200000, 0,  'speaker.jpg'],
        ];

        foreach ($produk as [$id, $nama, $desk, $harga, $stok, $gambar]) {
            DB::table('products')->insert([
                'id_barang' => $id, 'nama_barang' => $nama, 'deskripsi' => $desk,
                'harga' => $harga, 'stok' => $stok, 'gambar' => $gambar,
            ]);
        }
    }
}