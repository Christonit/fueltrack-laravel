<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vehicles', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');

            $table->string('maker');
            $table->string('model');
            $table->unsignedInteger('year');
            $table->unsignedInteger('usage_years')->nullable();
            $table->string('fueltype')->nullable();
            $table->unsignedInteger('init_miles')->nullable();
            $table->unsignedInteger('current_miles')->nullable();
            $table->boolean('user_vehicle_performance')->nullable();

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
        Schema::dropIfExists('user_vehicles');
    }
}
