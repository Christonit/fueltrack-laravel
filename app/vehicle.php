<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;


class vehicle extends Model
{
    //
    protected  $fillable = ['user','maker','model','year','meassurement_unit','fueltype','acquisition_date','init_miles','usage_years'];

    protected  $guarded = [];

    protected $table = 'user_vehicles';

    protected function maintenances(){

        return $this->hasMany('App\vehicle_maintenance', 'vehicle')
            ->where('status','=','1');
//                    ->where('due_moment', '=','Specific distance');

    }

    protected function fuelExpenses(){
        return $this->hasMany('App\expenses','vehicle');
    }



    protected function fuelExpensesSince($date){
        return $this->whereDate('created_at','>=',$date);
    }

    protected  function userVehicle(){

        return $this->where('user',auth()->id())
            ->value('id');
    }
    protected  function userVehicleInfo(){

        return $this->where('user',auth()->id())->get();
    }
}
