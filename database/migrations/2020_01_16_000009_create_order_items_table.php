<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Entities\OrderItem;
use App\Entities\Order;
use App\Entities\Product;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create((new OrderItem())->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->nullable(false);
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->unsignedDecimal('price', 12, 2)->nullable(false);
            $table->unsignedSmallInteger('quantity')->nullable(false);
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')->on((new Order())->getTable())
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')->on((new Product())->getTable())
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists((new OrderItem())->getTable());
    }
}
