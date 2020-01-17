<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Entities\Address;
use App\Entities\Country;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create((new Address())->getTable(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address')->nullable(false);
            $table->unsignedSmallInteger('zip_code')->nullable(false);
            $table->string('city')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->unsignedBigInteger('country_id')->nullable(false);
            $table->timestamps();

            $table->foreign('country_id')
                ->references('id')->on((new Country())->getTable())
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
        Schema::dropIfExists((new Address())->getTable());
    }
}
