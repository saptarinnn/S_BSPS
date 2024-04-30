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
        Schema::create('barang', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('nama', 100);
            $table->string('slug', 150);
            $table->string('gambar');
            $table->foreignUuid('kategori_id')->constrained('kategori')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('stok');
            $table->string('harga', 20);
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
