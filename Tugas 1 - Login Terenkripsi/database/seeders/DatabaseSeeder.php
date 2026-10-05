<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username'     => 'Irfan',
            'password'     => 'password123',
            'nama_lengkap' => 'Irfan Ardiansah Sulaeman',
        ]);

        User::create([
            'username'     => 'Aisy',
            'password'     => 'rahasia456',
            'nama_lengkap' => 'Aisy Fathryan Siswandar',
        ]);
    }
}