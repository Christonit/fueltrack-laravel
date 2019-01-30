<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    //
    protected  $fillable = ['user','maker','model','year','meassurement_unit','fueltype','acquisition_date','init_miles','usage_years'];

    protected  $guarded = [];

    protected $table = 'user_vehicles';
}
