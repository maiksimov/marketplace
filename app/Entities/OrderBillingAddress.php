<?php

namespace App\Entities;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;

class OrderBillingAddress extends Model
{
    use HasCompositePrimaryKey;

    protected $table = 'order_billing_addresses';
    protected $primaryKey = array('order_id', 'address_id');
    protected $fillable = [
        'order_id',
        'address_id',
    ];

    public function order()
    {
       return $this->belongsTo(Order::class);
    }

    public function address()
    {
       return $this->belongsTo(Address::class);
    }
}
