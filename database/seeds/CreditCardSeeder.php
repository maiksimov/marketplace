<?php

use Illuminate\Database\Seeder;
use App\Entities\Customer;
use App\Entities\CreditCard;

class CreditCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Customer::all() as $customer) {
            factory(CreditCard::class)->create(['customer_id' => $customer->id]);
        }
    }
}
