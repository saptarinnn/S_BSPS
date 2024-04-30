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
        Schema::create('servis', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('pemesanan_id')->constrained('pemesanan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('mekanik_id')->constrained('pengguna')->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('tgl_selesai_servis')->nullable();
            $table->enum('status_servis', ['1', '2', '3'])->default('1');
            $table->text('ket_servis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servis');
    }
};
