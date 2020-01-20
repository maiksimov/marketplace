<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'credit_cards';
    protected $fillable = [
        'number',
        'cvv',
        'expiration_month',
        'expiration_year',
        'first_name',
        'last_name',
        'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
