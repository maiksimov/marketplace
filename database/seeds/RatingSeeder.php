<?php

use Illuminate\Database\Seeder;
use App\Entities\Customer;
use App\Entities\Product;
use App\Entities\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $customers = Customer::get()->pluck('id')->toArray();

        foreach ($products as $product) {
            factory(Rating::class)->create(['product_id' => $product->id, 'customer_id' => $customers[array_rand($customers)]]);
        }
    }
}
