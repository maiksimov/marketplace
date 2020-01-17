<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Entities\Customer;

class CreateCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('number')->nullable(false);
            $table->unsignedSmallInteger('cvv')->nullable(false);
            $table->unsignedTinyInteger('expiration_month')->nullable(false);
            $table->unsignedSmallInteger('expiration_year')->nullable(false);
            $table->string('first_name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->timestamps();
            $table->foreign('customer_id')
                ->references('id')->on((new Customer())->getTable())
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
        Schema::dropIfExists('credit_cards');
    }
}
