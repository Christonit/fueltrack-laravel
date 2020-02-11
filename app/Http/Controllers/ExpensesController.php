<?php

namespace App\Http\Controllers;

use App\FuelPrices;
use Auth;
use App\expenses;
use App\vehicle;
use App\vehicle_performance;
use App\vehicle_maintenance;
use App\MaintenancesServicesPerformed;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;



class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fueltype = null;

        $logged_user_id = auth()->id();

        $vehicle_id = vehicle::
        where('user',$logged_user_id)
            ->value('id');


        $expenses =  request()->all();
        $date =  $request->input('Date');

        $expenses['vehicle'] = $vehicle_id;


        $getStarWeekDate = expenses::getStartofTheWeek(expenses::DateToWeekNumber($date),0)->format('Y-m-d');

        if (request()->input('FuelType') == 'Gasolina Premium'){
            $fueltype =   'gasolina_premium';
        }elseif (request()->input('FuelType') == 'Gasolina Regular'){
            $fueltype =   'gasolina_regular';

        }elseif (request()->input('FuelType') == 'GLP'){
            $fueltype =   'glp';

        }elseif (request()->input('FuelType') == 'Gas Natural'){
            $fueltype =   'gnv';

        }

        $fuelprice = FuelPrices::whereDate('start_of_week','=',$getStarWeekDate)->value($fueltype);

        $expenses['Current_fuel_price'] = $fuelprice;
        $expenses['Galons'] = (request()->input('budget')/$fuelprice);

//        return [$fueltype,$expenses];
        expenses::create($expenses);

        return 'Expense logged succesful.';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(expenses $expenses)
    {
        //
        $vehicle_id = vehicle::userVehicle();
        $expense = expenses::where('vehicle',$vehicle_id)->paginate(15);
        $vehicle_p = vehicle_performance::where('vehicle',$vehicle_id)->get();

        return compact(['expense','vehicle_p']);

    }


    public function latest()
    {

        $vehicle_id = vehicle::userVehicle();
        $expense = expenses::where('vehicle',$vehicle_id)->get()->sortBy('Created_at')->last();
        $vehicle_p = vehicle_performance::where('vehicle',$vehicle_id)->get();

        return compact(['expense','vehicle_p']);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(expenses $expenses)
    {
        //
    }
    public function averageGeneralExpenses(){
        $vehicle_averages['current_week'] =  collect($weekly_expenses['expense'])->last();

            //Tracked distance this week
            $vehicle_averages['tracked_current_week'] = round(expenses::galonsSinceDate($curent_week_date,$vehicle_id) * $avg_performance);

            //Monthly fuel ups avg
            $vehicle_averages['fuelups_current_month'] = expenses::where('vehicle',$vehicle_id)
                                                                   ->where('Date','>=',expenses::getMonthDates('current'))
                                                                   ->count();

            $vehicle_averages['fuelups_current_year'] = expenses::where('vehicle',$vehicle_id)
                                                                    ->where('Date','>=',date('Y').'-01-01')
                                                                    ->count();

            //Last month fuel ups
            $vehicle_averages['fuelups_last_month'] = expenses::where('vehicle',$vehicle_id)
                                                                ->where('Date','>=',expenses::getMonthDates('start'))
                                                                ->where('Date','<=',expenses::getMonthDates('last'))
                                                                ->count();

            //Last week expenses
            $vehicle_averages['last_week'] = collect($weekly_expenses['expense'][3])->sum();

            //Monthly expenses avg
            $vehicle_averages['last_month'] = expenses::totalExpensesByMonth('last month');

            //All time mileage
            $vehicle_averages['total_distance'] =   vehicle::where('user',$logged_user_id)->value('init_miles') +
                                                    (vehicle_performance::where('vehicle',$vehicle_id)->value('Avg_MPG')) *
                                                    (expenses::where('vehicle',$vehicle_id)
                                                                ->whereYear('Date',date('Y'))->pluck('Galons')->sum());
            //All time maintenance costs
            $vehicle_averages['total_maintenance_expenses'] = MaintenancesServicesPerformed::where('vehicle',$vehicle_id)
                                                                                             ->whereYear('date_performed',date('Y'))
                                                                                             ->pluck('cost')->sum();


            $new = $vehicle_averages['current_week'];

            $original = $vehicle_averages['last_week'];


            if($new == 0 || $original == 0){

                $vehicle_averages['increase_decrease_percentage'] = 0;

            }else{

                $vehicle_averages['increase_decrease_percentage'] = (($new - $original) / $original * 100);

            }

            $expenses = expenses::where('vehicle',$vehicle_id)->get()->reverse();

            $weekly_expenses = expenses::totalExpensesByWeek('gasolina_premium');


    }

    //This function returns all performed maintenances expenses.
    public function maintancesPerformedExpenses(){

        $vehicle = vehicle::where('user',auth()->id())->get();

        if(Auth::check() && count($vehicle) !== 0 ){

            $logged_user_id = auth()->id();

        
            $vehicle_id = vehicle::userVehicle();

            $curent_week_number = expenses::getVar('weekOfTheYear');
            $curent_week_date = expenses::getStartofTheWeek($curent_week_number,0)->format('y-m-d');



            $m_s_performed = vehicle_maintenance::getPerformedMaintenance($vehicle_id);

            //Lists all services performed in a maintenance.
            $m_s_list = $m_s_performed->pluck('maintenance_service')->unique()->values();

            //Sum all cost for a given service category done in a vehicle.
            foreach ($m_s_list as $i) {

                $maintenance_expenses[] = $m_s_performed->where('maintenance_service', $i)->sum('cost');
            }

            if( $m_s_performed->count() != 0) {

                $total_m_s_expenses = array_sum($maintenance_expenses);

            }else{
                $total_m_s_expenses = 0;

            }
            
            return $m_s_performed;
        }else{
            return 'Currently, you dont have a vehicle added.';
        }


    }
}
