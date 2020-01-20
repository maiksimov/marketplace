<?php

use Illuminate\Database\Seeder;
use App\Entities\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Country::class, 30)->create();
    }
}
