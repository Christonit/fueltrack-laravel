<?php

namespace App\Http\Controllers;

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

        $logged_user_id = auth()->id();

        $vehicle_id = vehicle::
        where('user',$logged_user_id)
            ->value('id');


        $expenses =  request()->all();

        $expenses['vehicle'] = $vehicle_id;


        expenses::create($expenses);

        return;
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
