<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'category_id',
        'product_name',
        'product_price',
        'product_photo',
        'product_description',
        'is_active'

    ];

    public function category()
    {
        //ini left join untuk relasi jadi table 
        return $this->belongsTo(Categoris::class, 'category_id', 'id');
    }

    // Relationship ke order_details (orderDetails)
    public function orderDetails()
    {
        return $this->hasMany(orderDetails::class, 'product_id');
    }

    // Jika Anda ingin menggunakan withCount
    public function scopePopular($query)
    {
        return $query->withCount('orderDetails')
            ->orderBy('order_details_count', 'desc');
    }
}
