<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'total_price' => null,
        'completed' => $faker->dateTime,
        'state' => 0,
        'customer_id' => null,
        'credit_card_id' => null,
    ];
});
