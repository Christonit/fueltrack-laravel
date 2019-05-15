<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
