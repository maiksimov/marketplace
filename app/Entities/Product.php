<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'title',
        'description',
        'price',
        'in_stock',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
