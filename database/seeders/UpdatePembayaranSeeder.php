<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdatePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembayaran')->where('id', 1)->update(['id_permohonan' => 1]);
        DB::table('pembayaran')->where('id', 2)->update(['id_permohonan' => 2]);
        DB::table('pembayaran')->where('id', 3)->update(['id_permohonan' => 3]);
    }
}
