<?php

use Illuminate\Database\Seeder;
use App\Entities\Category;
use App\Entities\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Category::all() as $category) {
            factory(Product::class, 10)->create(['category_id' => $category->id]);
        }
    }
}
