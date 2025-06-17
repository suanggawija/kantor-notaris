<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rak')->insert([
            'kode_rak' => "RAK-001",
            'nama_rak' => "Rak 1",
            'lokasi_rak' => "atas",
        ]);
        DB::table('rak')->insert([
            'kode_rak' => "RAK-002",
            'nama_rak' => "Rak 2",
            'lokasi_rak' => "atas no 2",
        ]);
        DB::table('rak')->insert([
            'kode_rak' => "RAK-003",
            'nama_rak' => "Rak 3",
            'lokasi_rak' => "tengah",
        ]);
        DB::table('rak')->insert([
            'kode_rak' => "RAK-004",
            'nama_rak' => "Rak 4",
            'lokasi_rak' => "bawah",
        ]);
        DB::table('rak')->insert([
            'kode_rak' => "RAK-005",
            'nama_rak' => "Rak 5",
            'lokasi_rak' => "atas",
        ]);
    }
}
