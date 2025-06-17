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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_log');
            $table->date('tlg_notifikasi');
            $table->string('isi_notifikasi');
            $table->string('jenis_notifikasi');
            $table->timestamps();

            $table->foreign('id_log')->references('id')->on('log')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
