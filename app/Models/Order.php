<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }


    public function carts()
    {
        return $this->hasMany(\App\Models\Cart::class);
    }

    public function bill()
    {
        return $this->hasOne(\App\Models\Bill::class, 'order_makanan_id');
    }

}
