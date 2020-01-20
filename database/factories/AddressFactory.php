<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'address' => $faker->unique()->address,
        'zip_code' => random_int(5),
        'city' => $faker->unique()->city,
        'phone' => $faker->unique()->phoneNumber,
        'country_id' => null,
    ];
});
