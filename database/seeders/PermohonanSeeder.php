<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permohonan')->insert([
            'id_rak' => 1,
            'id_klien' => 1,
            'id_pembayaran' => 1,
            'jenis_permohonan' => 'jual beli',
            'status_permohonan' => 'data berkas kurang',
            'keterangan_permohonan' => 'data kurang',
            'tanggal_pengajuan' => now(),
        ]);
        DB::table('permohonan')->insert([
            'id_rak' => 2,
            'id_klien' => 2,
            'id_pembayaran' => 2,
            'jenis_permohonan' => 'jual beli',
            'status_permohonan' => 'data berkas kurang',
            'keterangan_permohonan' => 'data kurang',
            'tanggal_pengajuan' => now(),
        ]);
        DB::table('permohonan')->insert([
            'id_rak' => 3,
            'id_klien' => 3,
            'id_pembayaran' => 3,
            'jenis_permohonan' => 'jual beli',
            'status_permohonan' => 'data berkas kurang',
            'keterangan_permohonan' => 'data kurang',
            'tanggal_pengajuan' => now(),
        ]);
    }
}
