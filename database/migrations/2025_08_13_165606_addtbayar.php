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
            $table->date('tanggal_tempo')->nullable();
            $table->string('metode')->default('termin');
            $table->dateTime('tbayar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restock', function (Blueprint $table) {
            $table->dropColumn('tanggal_tempo');
            $table->dropColumn('metode');
            $table->dropColumn('tbayar');
        });
    }
};
