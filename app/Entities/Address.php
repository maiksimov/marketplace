<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'address',
        'zip_code',
        'city',
        'phone',
        'country_id'
    ];
}
