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
        Schema::table('restock', function (Blueprint $table) {
            $table->dropForeign(['id_produk']); // drop FK dulu
            $table->dropColumn(['id_produk', 'jumlah', 'harga']); // drop kolom sekaligus
        });
    }

    /**
     * Reverse the migrations (opsional, untuk rollback).
     */
    public function down(): void
    {
        Schema::table('restock', function (Blueprint $table) {
            $table->foreignId('id_produk')->constrained('produk')->onDelete('cascade');
            $table->unsignedInteger('jumlah')->nullable(); // atau sesuaikan dengan tipe sebelumnya
            $table->unsignedBigInteger('harga')->nullable();
        });
    }
};
