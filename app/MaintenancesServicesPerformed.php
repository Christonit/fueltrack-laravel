<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\vehicle_maintenance;

class MaintenancesServicesPerformed extends Model
{
    //

    protected $fillable = ['vehicle',
                            'maintenance_service',
                            'service_category',
                            'cost','details',
                            'workshop',
                            'date_performed',
                            'warranty_insurance',
                            'original_rep',
                            'self_service'];


    protected $casts = [
                    'warranty_insurance' => 'boolean',
                    ];


    protected $table = 'maintenances_services_performed';


    protected function getMaintenancesExpenses($vehicleID){

        return $this->select('vehicle_maintenance.maintenance_service',
            'maintenances_services_performed.service_category',
            'maintenances_services_performed.cost')
                ->join('vehicle_maintenance', 'maintenances_services_performed.maintenance_service','=', 'vehicle_maintenance.id')
                ->where('maintenances_services_performed.vehicle','=',$vehicleID)
                ->get();
    }

}
