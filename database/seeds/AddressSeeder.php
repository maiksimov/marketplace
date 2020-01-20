<?php

use Illuminate\Database\Seeder;
use App\Entities\Country;
use App\Entities\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Country::all() as $country) {
            factory(Address::class, 20)->create(['country_id' => $country->id]);
        }
    }
}
