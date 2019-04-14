<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use \Carbon\CarbonImmutable;
use \DateTimeZone;

class expenses extends Model
{
    //
    protected  $fillable = ['vehicle','Galons','FuelType','Current_fuel_price','Date'];

    protected  $guarded = [];

    protected $casts = [ 'Current_fuel_price' => 'float'];

    protected $table = 'user_expenses';

    protected $getDate;

    protected $DayStartOfWeek;

    protected $DayEndOfWeek;

    protected $weekOfTheYear;

    public function __construct(array $attributes = [])
    {
        $this->getDate = CarbonImmutable::now();
        $this->DayStartOfWeek = Carbon::SATURDAY;
        $this->DayEndOfWeek =   Carbon::FRIDAY;

        $this->weekOfTheYear = $this->getDate->week();

        parent::__construct($attributes);

    }


    protected function getStartofTheWeek($weekOfTheYear, $weekIndexPointer){

        return $this->getDate->week($weekOfTheYear - $weekIndexPointer)->startOfWeek($this->DayStartOfWeek);

    }

    protected function getEndOfTheWeek($weekOfTheYear, $weekIndexPointer){

        return $this->getDate->week($weekOfTheYear - $weekIndexPointer)->endOfWeek($this->DayEndOfWeek);

    }


    public function getVehicleId(){

        $logged_user_id = auth()->id();

        return vehicle::where('user',$logged_user_id)->value('id');

    }


    protected  function galonsSinceDate($date,$id){

        return $this->whereDate('created_at','>=', date($date))
                    ->where('vehicle','=',$id)
                    ->pluck('Galons')->sum();

    }

    /**
     * @param $fuelType
     * @return mixed
     */
    protected function totalExpensesByWeek($fuelType){

        $currentWeek = $this->weekOfTheYear;

        for($i = 0; $i < 5; $i++){

            $startOfWeek = $this->getStartofTheWeek($currentWeek,$i);

            $endOfWeek = $this->getEndOfTheWeek($currentWeek,$i);

            $weeks[] = substr($startOfWeek->toFormattedDateString('m-d'), 0, -6).' - '.substr($endOfWeek->toFormattedDateString('m-d'),  0, -6);

            $galons =  $this->where('vehicle',$this->getVehicleId())
                            ->where('Date','>=',$startOfWeek->format('Y-m-d'))
                            ->where('Date', '<=', $endOfWeek->format('Y-m-d'))
                            ->pluck('Galons')->sum();

            $fuelPrices =  FuelPrices::whereDate('start_of_week',$startOfWeek->format('Y-m-d'))
                                        ->pluck($fuelType)->first();

            $expenses[] = str_replace(',','',number_format($galons * $fuelPrices, 2));

        }

        $last30Days['weeks'] = array_reverse($weeks);
        $last30Days['expense'] = array_reverse($expenses);

        return $last30Days;

    }


}
