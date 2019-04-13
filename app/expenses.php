<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FuelPrices;
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

    public function getVehicleId(){

        $logged_user_id = auth()->id();

        $vehicle_id = vehicle::
        where('user',$logged_user_id)
            ->value('id');

        return $vehicle_id;
    }


    protected  function galonsSinceDate($date,$id){

       return $this->whereDate('created_at','>=', date($date))
                    ->where('vehicle','=',$id)
                    ->pluck('Galons')->sum();
//        SELECT * FROM `user_expenses` WHERE `vehicle` = '1' AND `created_at` >= date('2019-02-02 00:00:00')

    }

    protected function totalExpensesByWeek(){

        $dateInterval = CarbonImmutable::now();
//        $dateInterval->startOfWeek(Carbon::FRIDAY);


//        $dateInterval = Carbon::now()->format('Y-m-d H:i');

        $start = Carbon::SATURDAY;
        $end = Carbon::FRIDAY;

//        end = $dateInterval->endOfWeek($end);

        $weekOfTheYear = $dateInterval->week();

//        $weekStart[] = $dateInterval->week($weekOfTheYear + 1 )->startOfWeek($start)->format('m-d');

        for($i = 0; $i < 5; $i++){
            $weeks[] = substr($dateInterval->week($weekOfTheYear - $i)->startOfWeek($start)->toFormattedDateString('m-d'), 0, -6).' - '.substr($dateInterval->week($weekOfTheYear - $i + 1)->startOfWeek($end)->toFormattedDateString('m-d'),  0, -6);

//            $weekStart[] = substr($dateInterval->week($weekOfTheYear - $i)->startOfWeek($start)->toFormattedDateString('m-d'), 0, -6);
//             $weekEnd[] = substr($dateInterval->week($weekOfTheYear - $i + 1)->startOfWeek($end)->toFormattedDateString('m-d'),  0, -6);


            $galons =  $this->where('Date','>=',
                $dateInterval->week($weekOfTheYear - $i)->startOfWeek($start)->format('Y-m-d')
            )
                ->where('Date', '<=', $dateInterval->week($weekOfTheYear - $i + 1)->startOfWeek($end)->format('Y-m-d'))
                ->pluck('Galons')->sum();


            $fuelPrices = FuelPrices::where('start_of_week','>=',
                $dateInterval->week($weekOfTheYear - $i)->startOfWeek($start)->format('Y-m-d'))
                ->where('end_of_week', '<', $dateInterval->week($weekOfTheYear - $i + 1)->startOfWeek($end)->format('Y-m-d'))
                ->pluck('gasolina_premium')->first();

            $expenses[] = str_replace(',','',number_format($galons * $fuelPrices, 2));

        }

        $last30Days['weeks'] = array_reverse($weeks);
        $last30Days['expense'] = array_reverse($expenses);



         return $last30Days;

//        $mCurrentWeekOfTheYear = $dateInterval->startOfWeek($start)->format('m-d');

//        $mLastWeek = $dateInterval->week($weekOfTheYear - 1)->startOfWeek($start)->format('m-d');
//
//        $mThirdWeek = $dateInterval->week($weekOfTheYear - 2)->startOfWeek($start)->format('m-d');
//
//        $mFourthWeek = $dateInterval->week($weekOfTheYear - 3)->startOfWeek($start)->format('m-d');
//
//        $mFithWeek = $dateInterval->week($weekOfTheYear - 4)->startOfWeek($start)->format('m-d');
//
//
//        $sCurrentWeekOfTheYear = $start->week($weekOfTheYear)->weekDay(7)->format('m-d');
//
//        $sLastWeek = $start->week($weekOfTheYear - 1)->weekDay(7)->format('m-d');
//
//        $sThirdWeek = $start->week($weekOfTheYear - 2)->weekDay(7)->format('m-d');
//
//        $sFourthWeek = $start->week($weekOfTheYear - 3)->weekDay(7)->format('m-d');
//
//        $sFithWeek = $start->week($weekOfTheYear - 4)->weekDay(7)->format('m-d');

//        $currentWeekOfTheYear = $dateInterval->week($weekOfTheYear)->format('m-d');
//
//        $lastWeek = $dateInterval->week($weekOfTheYear - 1)->format('m-d');
//
//        $thirdWeek = $dateInterval->week($weekOfTheYear - 2)->format('m-d');
//
//        $fourthWeek = $dateInterval->week($weekOfTheYear - 3)->format('m-d');

      $monday = $dateInterval->week($weekOfTheYear)->weekDay(1)->format('m-d');

      $sunday = $dateInterval->week($weekOfTheYear)->weekDay(7);

//      1. Gets Last four week dates
//      2. Get first and last day of week
//      3. Set first day, last  day, fuel price and total galons array.
//      4. Create method to calc total expenses in a given date range.
//      5. Create date a week dates array.
//      6. Create total expenses by week array.

        return $start;
        return [$mCurrentWeekOfTheYear,
                $mLastWeek,
                $mThirdWeek,
                $mFourthWeek,
                $mFithWeek];
//        return $this->where('vehicle',1)->whereBetween('Date',[ $thirdWeek , $fourthWeek ])->get();
//        return $this->where('vehicle',1)->where('Date','>=',$lastWeek)->pluck('Galons')->sum();
//        return [$fourthWeek,$thirdWeek,$lastWeek,$currentWeekOfTheYear];
    }


}
