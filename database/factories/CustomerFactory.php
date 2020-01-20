<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Customer;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('123456'),
    ];
});
