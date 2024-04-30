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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('pengguna_id')->constrained('pengguna')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tgl_pemesanan');
            $table->string('plat_nomor', 30);
            $table->string('merek', 50);
            $table->enum('status_pemesanan', ['0', '1', '2', '3'])->default('0');
            $table->text('ket_pemesanan');
            $table->text('ket_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
