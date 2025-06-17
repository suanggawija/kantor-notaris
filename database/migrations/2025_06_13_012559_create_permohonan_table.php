<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rak');
            $table->unsignedBigInteger('id_klien');
            $table->unsignedBigInteger('id_pembayaran')->nullable();
            $table->enum('jenis_permohonan', ['jual beli', 'hibah', 'hak tanggungan', 'waris']);
            $table->date('tanggal_pengajuan');
            $table->enum('status_permohonan', ['data berkas kurang', 'akan diproses', 'dalam proses', 'ditolak', 'diterima']);

            // files
            $table->string('ktp')->nullable();
            $table->string('kk')->nullable();
            $table->string('npwp')->nullable();
            $table->string('sertifikat_tanah')->nullable();
            $table->string('sppt_pbb')->nullable();
            $table->string('imb')->nullable();
            $table->string('sspd_bphtb')->nullable();
            $table->string('pph')->nullable();
            $table->string('akta_nikah')->nullable();
            $table->string('silsilah_waris')->nullable();
            $table->string('pernyataan_hibah')->nullable();
            $table->string('surat_pernyataan_waris')->nullable();
            $table->string('akta_kematian')->nullable();
            $table->string('akta_munita')->nullable();
            $table->string('keterangan_permohonan')->nullable();
            $table->timestamps();

            $table->foreign('id_rak')->references('id')->on('rak')->onDelete('cascade');
            $table->foreign('id_klien')->references('id')->on('klien')->onDelete('cascade');
            $table->foreign('id_pembayaran')->references('id')->on('pembayaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan');
    }
};
