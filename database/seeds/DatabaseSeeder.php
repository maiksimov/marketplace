<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CategorySeeder::class);
         $this->call(ProductSeeder::class);
         $this->call(CustomerSeeder::class);
         $this->call(CreditCardSeeder::class);
         $this->call(RatingSeeder::class);
         $this->call(CountrySeeder::class);
         $this->call(AddressSeeder::class);
    }
}
