<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'total_price',
        'completed',
        'state',
        'customer_id',
        'credit_card_id',
        'billing_address_id',
        'shipping_address_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function creditCard()
    {
        return $this->belongsTo(CreditCard::class, 'credit_card_id');
    }

    public function billingAddress()
    {
        return $this->hasOneThrough(Address::class, OrderBillingAddress::class, 'order_id','id', 'id', 'address_id');
    }

    public function shippingAddress()
    {
        return $this->hasOneThrough(Address::class, OrderShippingAddress::class, 'order_id','id', 'id', 'address_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
