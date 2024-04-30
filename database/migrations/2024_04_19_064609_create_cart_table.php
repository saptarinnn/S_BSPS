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
        Schema::create('cart', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('customer_id')->constrained('pengguna')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('barang_id')->constrained('barang')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('kuantitas');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
