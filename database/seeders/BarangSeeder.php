<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::factory()
            ->count(10)
            ->state(new Sequence(
                fn (Sequence $sequence) => ['kategori_id' => Kategori::all()->random()],
            ))
            ->create();
    }
}
