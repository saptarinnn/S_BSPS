<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'cart';

    protected $fillable = [
        'customer_id',
        'barang_id',
        'kuantitas',
        'total',
    ];

    public function customer()
    {
        return $this->belongsTo(Pengguna::class, 'customer_id', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
