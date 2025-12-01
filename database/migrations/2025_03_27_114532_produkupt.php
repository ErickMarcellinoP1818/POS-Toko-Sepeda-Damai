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
        Schema::create('produk', function (Blueprint $table){
            $table->id();
            $table->string('nama');
            $table->string('Kode');
            $table->integer('harga');
            $table->integer('stok');
            $table->string('status');
            $table->string('gambar');
            $table->foreignId('id_kategori')->nullable()->constrained('kategori')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
