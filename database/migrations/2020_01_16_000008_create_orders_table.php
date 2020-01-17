<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Entities\Order;
use App\Factories\StateFactory;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create((new Order())->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedDecimal('total_price', 12, 2)->nullable(false)->default(0.0);
            $table->timestamp('completed');
            $table->unsignedSmallInteger('state')->nullable(false)->default((new StateFactory())->defaultState());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists((new Order())->getTable());
    }
}
