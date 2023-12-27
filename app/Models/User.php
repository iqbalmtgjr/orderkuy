<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook_id',
        'google_id',
        'avatar',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function dapur()
    {
        return $this->hasOne(Dapur::class);
    }

    public function kasir()
    {
        return $this->hasOne(Kasir::class);
    }

    public function toko()
    {
        return $this->hasOne(Toko::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
