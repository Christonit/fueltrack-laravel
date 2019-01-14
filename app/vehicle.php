<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    //
    protected  $fillable = ['user','maker','model','year','usage_years','fueltype','init_miles','current_miles'];

    protected  $guarded = [];

    protected $table = 'user_vehicles';
}
