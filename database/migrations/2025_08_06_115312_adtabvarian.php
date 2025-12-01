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
        Schema::create('varian', function (Blueprint $table){
            $table->id();
            $table->foreignId('id_produk')->constrained('produk');;
            $table->string('nama_varian');
            $table->integer('harga');
            $table->string('gambar');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varian');
    }
};
