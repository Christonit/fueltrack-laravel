<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_performance', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vehicle');
            $table->float('City_MPG');
            $table->float('Highway_MPG');
            $table->float('Avg_MPG');
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
        Schema::dropIfExists('vehicle_performance');
    }
}
