<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bill'; 

    protected $fillable = [
        'order_makanan_id',
        'total_bayar',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_makanan_id');
    }
}
