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
            $table->unsignedInteger('gasolina_premium');
            $table->unsignedInteger('gasolina_regular');
            $table->unsignedInteger('gasoil_optimo');
            $table->unsignedInteger('gasoil_regular');
            $table->unsignedInteger('kerosene');
            $table->unsignedInteger('glp');
            $table->unsignedInteger('gnv');
            $table->date('start_of_week');
            $table->date('end_of_week');
            $table->date('country');
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
