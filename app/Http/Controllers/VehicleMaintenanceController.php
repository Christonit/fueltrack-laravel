<?php

namespace App\Http\Controllers;
use App\vehicle;
use App\User;
use App\vehicle_performance;
use App\vehicle_maintenance;
use App\MaintenancesServicesPerformed;
use App\expenses;
use Auth;

use function GuzzleHttp\Promise\all;
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

//        return request()->all();


//        $vehicle_maintenance = new vehicle_maintenance();

        $service = request()->validate([
            'maintenance_service'=>['required'],
            'due_moment'=>['required']
        ]);




        $service['vehicle'] = vehicle::userVehicle();


        if( $service['due_moment'] == 'Specific distance'){

            $tracked_distance = request()->validate(['tracked_distance' => ['required','numeric']]);
            $service = array_merge($service,$tracked_distance);
        }elseif ( $service['due_moment'] == 'Specific date'){
            $date = request()->validate(['final_date' => ['required','date']]);
            $service = array_merge($service,$date);
        }



        $service['status'] = true;


         vehicle_maintenance::create($service);


//        $vehicle_maintenance->status = $status;
//
//        $vehicle_maintenance->save();






        return;



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
//return $id;

        $maintenance = MaintenancesServicesPerformed::where('maintenance_service',$id)->get();

         $maintenance[0]['title'] =  vehicle_maintenance::find($id)->value('maintenance_service');


        return view('utilities.edit.maintenance',compact('maintenance'));

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

        $maintenance = request()->validate([
            'cost'=>['min:3'],
            'service_category'=>['required','min:8'],
            'date_performed'=>['required'],
            'workshop'=>['string','min:4'],
            'warranty_insurance'=>['boolean'],
            'self-service'=>['boolean'],
            'original_rep'=>['boolean'],
            'details'=>['string'],
        ]);
//        return $maintenance;

        $maintenance = MaintenancesServicesPerformed::find($id)->fill($maintenance)->save();

        return redirect('/'.auth()->user()->username.'/my-car');


    }

    public  function latestPerformed(){

        $performed = vehicle_maintenance::latestMaintenancePerformed();

        return view('vehicle.maintenance-history-template',compact('performed'));
    }


    public  function latestAdded(){

        $maintenances = vehicle_maintenance::latestMaintenanceAdded();

        return view('vehicle.maintenance-template',compact('maintenances'));
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

    public function delete($id)
    {
        //
//return $id;

        $maintenance = MaintenancesServicesPerformed::where('maintenance_service',$id)->get();

        $maintenance[0]['title'] =  vehicle_maintenance::find($id)->value('maintenance_service');


        return view('utilities.delete-maintenance',compact('maintenance'));

    }

    public function destroy($id)
    {
        //


        $maintenance = MaintenancesServicesPerformed::findOrFail($id);
//        ->delete();
        $vehicle_maintenance = vehicle_maintenance::find($maintenance->maintenance_service)->delete();

        $maintenance->delete();

        return redirect('/'.auth()->user()->username.'/my-car');




    }
}
