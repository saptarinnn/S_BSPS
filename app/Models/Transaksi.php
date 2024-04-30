<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'transaksi';

    protected $fillable = [
        'customer_id',
        'kode_unik',
        'tgl_transaksi',
        'status_transaksi',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tgl_transaksi' => 'date',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Pengguna::class, 'customer_id', 'id');
    }

    public function detail_transaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id', 'id');
    }
}
