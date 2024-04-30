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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('customer_id')->constrained('pengguna')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('kode_unik', 8);
            $table->date('tgl_transaksi');
            $table->enum('status_transaksi', ['0', '1', '2', '3']);
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
