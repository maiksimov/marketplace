<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Rating;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'review' => $faker->sentence(10),
        'rating' => random_int(0, 10),
        'customer_id' => null,
        'product_id' => null
    ];
});
