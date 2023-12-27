<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $fillable = ['toko_id', 'qty', 'nama_produk', 'kategori', 'harga', 'estimasi', 'foto'];
    protected $guarded = [];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
