<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'order_id' => null,
        'product_id' => null,
        'price' => null,
        'quantity' => null,
    ];
});
