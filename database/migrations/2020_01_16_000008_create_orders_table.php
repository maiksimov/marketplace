<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Entities\Order;
use App\Entities\Customer;
use App\Entities\CreditCard;
use App\Entities\Address;
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
            $table->unsignedTinyInteger('state')->nullable(false)->default((new StateFactory())->defaultState());
            $table->unsignedBigInteger('customer_id')->nullable(false);
            $table->unsignedBigInteger('credit_card_id')->nullable(false);
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')->on((new Customer())->getTable())
                ->onDelete('cascade');
            $table->foreign('credit_card_id')
                ->references('id')->on((new CreditCard())->getTable())
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
        Schema::dropIfExists((new Order())->getTable());
    }
}
