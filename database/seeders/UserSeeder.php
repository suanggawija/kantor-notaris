<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'nama_user' => 'admin',
            'jabatan_user' => 'admin', // ← perbaiki di sini
            'no_telp_user' => '0000000000',
            'alamat_user' => 'Jl. Kenangan',
        ]);

        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('password'),
            'nama_user' => 'admin2',
            'jabatan_user' => 'admin', // ← perbaiki di sini
            'no_telp_user' => '0000000000',
            'alamat_user' => 'Jl. Kenangan 2',
        ]);
    }
}
