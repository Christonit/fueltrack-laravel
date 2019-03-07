<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuelPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->float('gasolina_premium');
            $table->float('gasolina_regular');
            $table->float('gasoil_optimo');
            $table->float('gasoil_regular');
            $table->float('kerosene');
            $table->float('glp');
            $table->float('gnv');
            $table->date('start_of_week');
            $table->date('end_of_week');
            $table->string('country');
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
        Schema::dropIfExists('fuel_prices');
    }
}
