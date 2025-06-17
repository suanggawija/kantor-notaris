<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KlienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('klien')->insert([
            'nama_klien' => 'klien 1',
            'email_klien' => 'klien1@gmail.com',
            'no_telp_klien' => '0000000000',
            'alamat_klien' => 'Jl. Kenangan 1',
            'nik_klien' => '111111111111111',
        ]);
        DB::table('klien')->insert([
            'nama_klien' => 'klien 2',
            'email_klien' => 'klien2@gmail.com',
            'no_telp_klien' => '0000000000',
            'alamat_klien' => 'Jl. Kenangan 1',
            'nik_klien' => '111111111111112',
        ]);
        DB::table('klien')->insert([
            'nama_klien' => 'klien 3',
            'email_klien' => 'klien3@gmail.com',
            'no_telp_klien' => '0000000000',
            'alamat_klien' => 'Jl. Kenangan 1',
            'nik_klien' => '111111111111113',
        ]);
    }
}
