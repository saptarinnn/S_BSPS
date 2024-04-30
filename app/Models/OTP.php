<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'otp';

    protected $fillable = [
        'pengguna_id',
        'otp',
        'time_send',
    ];

    protected function casts(): array
    {
        return [
            'time_send' => 'date',
        ];
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'id');
    }
}
