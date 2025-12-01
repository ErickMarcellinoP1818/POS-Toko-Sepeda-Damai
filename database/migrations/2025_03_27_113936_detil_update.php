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
        Schema::create('detil_nota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_nota')->nullable()->constrained('nota')->nullOnDelete();
            $table->foreignId('id_produk')->nullable()->constrained('produk')->nullOnDelete();
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detil_nota');
    }
};
