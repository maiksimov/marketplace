<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\CreditCard;
use Faker\Generator as Faker;

$factory->define(CreditCard::class, function (Faker $faker) {
    return [
        'number' => $faker->unique()->creditCardNumber,
        'cvv' => random_int(111,999),
        'expiration_month' => $faker->creditCardExpirationDate->format('m'),
        'expiration_year' => $faker->creditCardExpirationDate->format('Y'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'customer_id' => null,
    ];
});
