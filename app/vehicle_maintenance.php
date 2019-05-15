<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle_maintenance extends Model
{
    //
    protected  $fillable =   ['vehicle',
                            'maintenance_service',
                            'due_moment',
                            'tracked_distance',
                            'status','final_date'
                            ];

//    protected $guarded = ['final_date','status','current_distance','overdue_distance'];

    protected $table = 'vehicle_maintenance';


    protected function  ActiveMaintenanceByDistance($id){

        $maintenances = $this->where('vehicle','=',$id)
//                            ->where('due_moment', '=','Specific distance')
                            ->where('status','=','1')
                            ->get();

       return $maintenances;

    }

    protected function  latestMaintenanceAdded($id){




       return $this->select('vehicle_maintenance.id',
           'vehicle_maintenance.maintenance_service',
           'vehicle_maintenance.due_moment',
           'maintenances_services_performed.service_category',
           'maintenances_services_performed.cost',
           'maintenances_services_performed.details',
           'maintenances_services_performed.workshop',
           'maintenances_services_performed.date_performed',
           'maintenances_services_performed.warranty_insurance',
           'maintenances_services_performed.original_rep',
           'maintenances_services_performed.created_at',
           'vehicle_maintenance.tracked_distance',
           'vehicle_maintenance.overdue_distance',
           'maintenances_services_performed.self_service')
           ->join('maintenances_services_performed', 'vehicle_maintenance.id','=', 'maintenances_services_performed.maintenance_service')
                   ->where('vehicle_maintenance.vehicle',$id)
                   ->where('vehicle_maintenance.status','false')->latest()->first();

    }

    protected function getPerformedMaintenance($vehicleID){

        return $this->select('vehicle_maintenance.id',
            'vehicle_maintenance.maintenance_service',
            'vehicle_maintenance.due_moment',
            'maintenances_services_performed.service_category',
            'maintenances_services_performed.cost',
            'maintenances_services_performed.details',
            'maintenances_services_performed.workshop',
            'maintenances_services_performed.date_performed',
            'maintenances_services_performed.warranty_insurance',
            'maintenances_services_performed.original_rep',
            'vehicle_maintenance.tracked_distance',
            'vehicle_maintenance.overdue_distance',
            'maintenances_services_performed.self_service')
                ->join('maintenances_services_performed', 'vehicle_maintenance.id','=', 'maintenances_services_performed.maintenance_service')
                ->where('vehicle_maintenance.vehicle','=',$vehicleID)
                ->where('vehicle_maintenance.status','=','0')
                ->get();
    }



//    protected function user(){
//        return $this->belongsTo('App\vehicle','vehicle');
//    }



}
