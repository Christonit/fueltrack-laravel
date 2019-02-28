<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expenses extends Model
{
    //
    protected  $fillable = ['vehicle','Galons','FuelType','Current_fuel_price','Date'];

    protected  $guarded = [];

    protected $casts = [ 'Current_fuel_price' => 'float'];

    protected $table = 'user_expenses';

    public function getVehicleId(){

        $logged_user_id = auth()->id();

        $vehicle_id = vehicle::
        where('user',$logged_user_id)
            ->value('id');

        return;
    }


    protected  function galonsSinceDate($date,$id){

       return $this->whereDate('created_at','>=', date($date))
                    ->where('vehicle','=',$id)
                    ->pluck('Galons')->sum();
//        SELECT * FROM `user_expenses` WHERE `vehicle` = '1' AND `created_at` >= date('2019-02-02 00:00:00')

    }


}
