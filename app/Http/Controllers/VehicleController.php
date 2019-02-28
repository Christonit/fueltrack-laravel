<?php

namespace App\Http\Controllers;

use App\vehicle;
use App\User;
use App\vehicle_performance;
use App\vehicle_maintenance;
use App\expenses;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

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

//        $new_vehicle = request()->validate([
//            'maker'=>['required','min:3'],
//            'model'=>['required'],
//            'year'=>['required','min:4','max:4'],
//
//        ]);

        $new_vehicle = request()->validate([
            'maker'=>['required','min:3'],
            'model'=>['required'],
            'year'=>['required','min:4','max:4'],
            'usage_years'=>['required'],
            'acquisition_date'=>['required'],
            'init_miles'=>['required'],
            'meassurement_unit'=>['required'],
            'fueltype'=>['required'],


        ]);



        $logged_user_id = auth()->id();

        $logged_user = auth()->user()->username;


        //Id of Vehicle of the logged user



        $vehicle_performance = request()->validate(['City_MPG'=>'required',
                                                    'Avg_MPG'=>'required',
                                                    'Highway_MPG'=>'required']);





//        $add_performance  = $request->input('name');




//        $new_vehicle = $request->all();


        $new_vehicle['user'] = $logged_user_id;


        vehicle::create($new_vehicle);



        $vehicle_id = vehicle::
        where('user',$logged_user_id)
            ->value('id');

        $vehicle_performance['vehicle'] = $vehicle_id;



//        return $new_vehicle;

        vehicle_performance::create($vehicle_performance);



//        return [$vehicle_performance,$new_vehicle];





        return redirect('/'.$logged_user.'/my-car');
//        return false;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $logged_user_id = auth()->id();

        $vehicle = vehicle::
        where('user',$logged_user_id)->get();


        if(Auth::check() && count($vehicle) !== 0 ){


//


//        $fuel_expenses = vehicle::find(1)->fuelExpensesSince('2017-01-01');

            $vehicle_id = vehicle::
            where('user',$logged_user_id)
                ->value('id');

            $vehicle_p = vehicle_performance::where('vehicle',$vehicle_id)->get();

            $maintenance =  vehicle::find($vehicle_id)->maintenances;
//            $maintenance =  vehicle::find($vehicle_id)->maintenances;


            //1. Gets totals of galons following a given date greater or equal than the date when a maintenance was added as active.

            $fuel_expenses = expenses::galonsSinceDate('2017-02-1',$vehicle_id);


//            $prueba = $maintenance->toArray();
//            return if();




            $avg_performance = $vehicle_p[0]['Avg_MPG'];


            foreach($maintenance as $maintenances){

                if($maintenances->due_moment == 'Specific distance'){

                    $galons = expenses::galonsSinceDate($maintenances->created_at,$vehicle_id);


                    vehicle_maintenance::where('vehicle','=',$vehicle_id)
                        ->where('id', '=',$maintenances->id)
                        ->where('due_moment', '=','Specific distance')
                        ->where('status','=','1')
                        ->update(['current_distance' => ($avg_performance * $galons) ]);


                }


            }









            $expenses = expenses::where('vehicle',$vehicle_id)->get();



            return view('/my-car', compact(['vehicle','vehicle_p','expenses','maintenance']) );

        }else{


            return redirect('/');

        }



        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(vehicle $vehicle)
    {
        //
    }


}
