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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
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
        // return $request;
        $fueltype = null;

        $logged_user_id = auth()->id();

        $vehicle_id = vehicle::
        where('user',$logged_user_id)
            ->value('id');

        $expenses =  request()->all();

        $validator =  Validator::make($expenses,[
            'FuelType'=>'required|string',
            'budget'=>'required|numeric',
            'Date'=>'required|date'
        ]);

        if($validator->fails()){
            $errors['Errors'] = $validator->messages();
            return $errors;
        }


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

        return expenses::create($expenses);

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
    public function lastWeeks(){

        return $weekly_expenses = expenses::last5Weeks();

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
