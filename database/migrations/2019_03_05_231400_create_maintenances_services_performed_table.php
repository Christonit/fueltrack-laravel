<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancesServicesPerformedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances_services_performed', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('vehicle')->references('id')->on('vehicle_maintenance')->onDelete('cascade');
            $table->unsignedInteger('maintenance_service');
            $table->string('service_category');
            $table->float('cost')->nullable();
            $table->string('details')->nullable();
            $table->string('workshop');
            $table->date('date_performed');
            $table->boolean('warranty_insurance');
            $table->boolean('original_rep')->nullable();
            $table->boolean('self_service')->nullable();
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
        Schema::dropIfExists('maintenances_services_performed');
    }
}
