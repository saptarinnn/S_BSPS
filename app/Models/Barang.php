<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'barang';

    protected $fillable = [
        'nama',
        'slug',
        'gambar',
        'kategori_id',
        'stok',
        'harga',
        'deskripsi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function barang_masuks()
    {
        return $this->hasMany(BarangMasuk::class, 'barang_id', 'id');
    }

    public function detail_transaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'barang_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'barang_id', 'id');
    }
}
