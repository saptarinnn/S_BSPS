<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pemesanan';

    protected $fillable = [
        'pengguna_id',
        'tgl_pemesanan',
        'plat_nomor',
        'merek',
        'status_pemesanan',
        'ket_pemesanan',
        'ket_status',
    ];

    protected function casts(): array
    {
        return [
            'tgl_pemesanan' => 'date',
        ];
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'id');
    }

    public function serviss()
    {
        return $this->hasMany(Servis::class, 'pemesanan_id', 'id');
    }
}
