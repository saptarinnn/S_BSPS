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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('barang_id')->constrained('barang')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('transaksi_id')->constrained('transaksi')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('jumlah_pembelian');
            $table->integer('sub_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
