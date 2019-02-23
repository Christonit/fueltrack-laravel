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


    protected  function galonsSinceDate($date){

       return $this->whereDate('created_at','>=', $date)->select('Galons')->get();

    }

    protected function  getLoggedUserExpense($test){


        return 'Esto es una prueba '.$test;
    }

}
