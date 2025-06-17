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
        Schema::table('log', function (Blueprint $table) {
            $table->unsignedBigInteger('id_notifikasi')->nullable();
            $table->foreign('id_notifikasi')->references('id')->on('notifikasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log', function (Blueprint $table) {
            $table->dropForeign(['id_notifikasi']);
            $table->dropColumn('id_notifikasi');
        });
    }
};
