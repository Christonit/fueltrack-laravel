<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_maintenance', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('vehicle')->references('id')->on('user_vehicles')->onDelete('cascade');
            $table->string('maintenance_service');
//            $table->string('service_category');
//            $table->string('service_type');
//            $table->string('title');
//            $table->unsignedInteger('cost')->nullable();
            $table->string('due_moment');
            $table->boolean('status');
            $table->date('final_date')->nullable();
            $table->unsignedInteger('ini_distance')->nullable();
            $table->unsignedInteger('tracked_distance')->nullable();
            $table->unsignedInteger('current_distance')->nullable();
            $table->unsignedInteger('overdue_distance')->nullable();

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
        Schema::dropIfExists('vehicle_maintenance');
    }
}
