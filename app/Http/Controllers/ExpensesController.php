<?php

namespace App\Http\Controllers;

use App\FuelPrices;
use Auth;
use App\expenses;
use App\vehicle;
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

    }


    public function latest()
    {
        //

        $logged_user_id = auth()->id();

        $vehicle_id = vehicle::
        where('user',$logged_user_id)
            ->value('id');


        $latestExpense = expenses::where('vehicle',$vehicle_id)->get()->sortBy('Created_at')->last();

        return view('vehicle.latest-expense',compact('latestExpense'));


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
}
