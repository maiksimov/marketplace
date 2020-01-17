<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Entities\Product;
use App\Entities\Customer;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('review')->nullable(false);
            $table->unsignedTinyInteger('rating')->nullable(false);
            $table->unsignedBigInteger('customer_id')->nullable(false);
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')->on((new Customer())->getTable())
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on((new Product())->getTable())
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
        Schema::dropIfExists('ratings');
    }
}
