<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restock', function(Blueprint $table)
        {
            $table->id();
            $table->foreignId('id_supplier')->constrained('supplier');
            $table->foreignId('id_produk')->nullable()->constrained('produk');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('total');
            $table->date('tanggal')->default(Carbon::today());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restock');
    }
};
