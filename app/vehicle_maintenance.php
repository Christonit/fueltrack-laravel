<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle_maintenance extends Model
{
    //
    protected  $fillable =   ['vehicle',
                            'service_type',
                            'title',
                            'cost',
                            'due_moment',
                            'tracked_distance',
                            'status'
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

//    protected function user(){
//        return $this->belongsTo('App\vehicle','vehicle');
//    }



}
