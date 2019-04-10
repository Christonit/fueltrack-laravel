<?php

namespace App\Http\Controllers;
use App\vehicle;
use App\User;
use App\vehicle_performance;
use App\vehicle_maintenance;
use App\MaintenancesServicesPerformed;
use App\expenses;
use Auth;

use Illuminate\Http\Request;

class VehicleMaintenanceController extends Controller
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

//        $vehicle_maintenance = new vehicle_maintenance();

        $service = request()->validate([
            'title'=>['required','min:3'],
            'service_type'=>['required'],
            'due_moment'=>['required']
        ]);


        $service['vehicle'] = vehicle::
        where('user',auth()->id())
            ->value('id');


        if( $service['due_moment'] == 'Specific distance'){

            $tracked_distance = request()->validate(['tracked_distance' => ['required','numeric']]);
            $service = array_merge($service,$tracked_distance);
        }



        $service['status'] = true;

//        $status = true;

         vehicle_maintenance::create($service);


//        $vehicle_maintenance->status = $status;
//
//        $vehicle_maintenance->save();






        return $service;



        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }



    public function markAsPerformed(Request $request, $id)
    {

        $maintenance_details = $request->all();

        $maintenance = vehicle_maintenance::find($id);

        $maintenance['status'] = false;

        $maintenance_details['vehicle'] = $maintenance->vehicle;

        $maintenance->save();

        MaintenancesServicesPerformed::create($maintenance_details);

        return;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}