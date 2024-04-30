<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'servis';

    protected $fillable = [
        'pemesanan_id',
        'mekanik_id',
        'tgl_selesai_servis',
        'status_servis',
        'ket_servis',
    ];

    protected function casts(): array
    {
        return [
            'tgl_selesai_servis' => 'date',
        ];
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'id');
    }

    public function mekanik()
    {
        return $this->belongsTo(Pengguna::class, 'mekanik_id', 'id');
    }
}
