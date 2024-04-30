<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Pengguna extends Authenticatable
{
    use HasFactory, HasRoles, HasUuids, Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'nama', 'no_hp', 'username', 'password', 'login_terakhir', 'aktif',
    ];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return [
            'login_terakhir' => 'date',
            'password' => 'hashed',
        ];
    }

    public function getSomeDate($date)
    {
        return $date->format('d F Y');
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'pemesanan_id', 'id');
    }

    public function serviss()
    {
        return $this->hasMany(Servis::class, 'mekanik_id', 'id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'customer_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }

    public static function roleMekanik()
    {
        return Pengguna::whereHas('roles', function (Builder $query) {
            $query->where('name', 'mekanik');
        })->get();
    }

    public function otp()
    {
        return $this->hasOne(OTP::class, 'pengguna_id', 'id');
    }
}
