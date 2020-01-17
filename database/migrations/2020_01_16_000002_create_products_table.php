<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Entities\Category;
use App\Entities\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create((new Product())->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable(false);
            $table->text('description');
            $table->decimal('price')->nullable(false)->default(0.0);
            $table->unsignedInteger('in_stock')->nullable(false)->default(0);
            $table->bigIncrements('category_id')->nullable(false);
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')->on((new Category())->getTable())
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
