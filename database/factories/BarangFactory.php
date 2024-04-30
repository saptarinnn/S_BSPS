<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'nama' => $name,
            'slug' => Str::slug($name),
            'gambar' => Str::slug($name),
            'stok' => 0,
            'harga' => fake()->numberBetween('10000', '100000'),
            'deskripsi' => fake()->text(),
        ];
    }
}
