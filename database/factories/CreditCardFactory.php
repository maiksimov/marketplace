<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'number' => $faker->unique()->creditCardNumber,
        'cvv' => random_int(3,3),
        'expiration_month' => $faker->creditCardExpirationDate->format('m'),
        'expiration_year' => $faker->creditCardExpirationDate->format('Y'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'customer_id' => null,
    ];
});
