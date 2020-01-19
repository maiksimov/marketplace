<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->sentence(4),
        'description' => $faker->paragraph,
        'price' => random_int(1, 1000),
        'in_stock' => random_int(0, 100),
        'category_id' => null,
    ];
});
