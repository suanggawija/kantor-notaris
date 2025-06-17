<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembayaran')->insert([
            'tgl_pembayaran' => now(),
            'total_pembayaran' => 2000000,
            // 'id_permohonan' => 1,
        ]);

        DB::table('pembayaran')->insert([
            'tgl_pembayaran' => now(),
            'total_pembayaran' => 2000000,
            // 'id_permohonan' => 2,
        ]);

        DB::table('pembayaran')->insert([
            'tgl_pembayaran' => now(),
            'total_pembayaran' => 2000000,
            // 'id_permohonan' => 3,
        ]);
    }
}
