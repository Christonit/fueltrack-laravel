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

}
