<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use \Carbon\CarbonImmutable;
use \DateTimeZone;
use DateTime;

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

    public $weekOfTheYear;



    public function __construct(array $attributes = [])
    {
        $this->getDate = CarbonImmutable::now();
        $this->DayStartOfWeek = Carbon::SATURDAY;
        $this->DayEndOfWeek =   Carbon::FRIDAY;

        $this->weekOfTheYear = $this->getDate->week();

        parent::__construct($attributes);


    }

    protected  function DateToWeekNumber($date){

        $dateTime = new DateTime($date);

        return $dateTime->format('W');
    }

    protected function getStartofTheWeek($weekOfTheYear, $weekIndexPointer){

        return $this->getDate->week($weekOfTheYear - $weekIndexPointer)->startOfWeek($this->DayStartOfWeek);


    }



    protected function getEndOfTheWeek($weekOfTheYear, $weekIndexPointer){

        return $this->getDate->week($weekOfTheYear - $weekIndexPointer)->endOfWeek($this->DayEndOfWeek);

    }


//    0 gets start and end of current week and 1 gets last week dates
    protected function getWeekStartDates($week){

        return $this->getDate->startOfWeek(Carbon::MONDAY)->subWeek($week);

    }

    //    0 gets start and end of current week and 1 gets last week dates

    protected function getWeekEndDates($week){

        return $this->getDate->startOfWeek(Carbon::SATURDAY)->subWeek($week);

    }


    protected function getMonthDates($moment){

        $condition = $moment;


        if($condition == 'current'){

            return $this->getDate->firstOfMonth();

        }elseif ($condition == 'last'){

            return $this->getDate->lastOfMonth()->subMonths(1);

        }elseif ($condition == 'start'){

            return $this->getDate->startOfMonth()->subMonths(1);

        }


    }




    public function getVehicleId(){

        $logged_user_id = auth()->id();

        return vehicle::where('user',$logged_user_id)->value('id');

    }


    protected  function galonsSinceDateRange($date){

        return date($date);
//        return $this->whereDate('created_at','>=', date($date))
//                    ->where('vehicle','=',$id)
//                    ->pluck('Galons')->sum();

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
    protected function last5Weeks(){

        $currentWeek = $this->weekOfTheYear;
        $galons = array();
        $expenses = [];

        for($i = 0; $i < 5; $i++){

            $startOfWeek = $this->getStartofTheWeek($currentWeek,$i);
            $endOfWeek = $this->getEndOfTheWeek($currentWeek,$i);

            $weeks[] = substr($startOfWeek->toFormattedDateString('m-d'), 0, -6).' - '.substr($endOfWeek->toFormattedDateString('m-d'),  0, -6);

            $galons[]=  $this->where('vehicle',$this->getVehicleId())
                            ->where('Date','>=',$startOfWeek->format('Y-m-d'))
                            ->where('Date', '<=', $endOfWeek->format('Y-m-d'))
                            ->get(['Galons','Current_fuel_price','Date']);
            
            // $fuelPrices =  FuelPrices::whereDate('start_of_week',$startOfWeek->format('Y-m-d'))
            //                             ->pluck($fuelType)->first();

            // $expenses[] = str_replace(',','',number_format($galons * $fuelPrices, 2));

        }
        // dd( sizeof($galons[1]) );
        foreach($galons as $galon){

            if(sizeof($galon) != 0){
                $sum = null;
                foreach($galon as $item){
                    $sum += $item->Galons * $item->Current_fuel_price;
                }

                $expenses[]= $sum;

            }else{
                $expenses[]= 0;
            }

        }

        $last5Weeks['Dates'] = array_reverse($weeks);
        $last5Weeks['Expenses'] = array_reverse($expenses);

        return $last5Weeks;

    }


//Get expenses by month
    protected function totalExpensesByMonth($date){
        $month = $date;


        if($month == 'last month'){
            $expenses = $this->whereMonth('Date',($this->getDate->month - 1))->select('Current_fuel_price','Galons')->get();
        }

            
            if( sizeof($expenses)  !== 0 ){

                foreach ($expenses as $expense){

                    $monthlyExpense[] = $expense['Current_fuel_price'] * $expense['Galons'];
    
                }

                return round(collect($monthlyExpense)->sum());

            
            }else{
                return 0;
            };
            



    }

    protected function totalGalonsGlobal($vehicle)
    {
        return $this->where('vehicle',$vehicle)->pluck('Galons')->sum();


    }


    protected function getVar($variable)
    {
        return $this->$variable;
    }


}
