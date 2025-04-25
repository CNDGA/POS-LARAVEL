<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderDetails extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'order_price',
        'order_subtotal',
    ];

    //mengambil 1 relasi dari data base
    public function order()

    {
        //ambil data base di orders dmana yg di ambil order_id untuk id orderdetail
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    public function product()
    //ambil data base di products dmana yg di ambil product_id untuk id 
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
