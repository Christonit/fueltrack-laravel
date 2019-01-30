<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicle_performance extends Model
{
    //

    protected  $fillable = ['City_MPG','Highway_MPG','Avg_MPG','vehicle'];

    protected  $guarded = [];

    protected $table = 'vehicle_performance';
}
