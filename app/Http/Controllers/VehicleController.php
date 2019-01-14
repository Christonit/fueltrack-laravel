<?php

namespace App\Http\Controllers;

use App\vehicle;
use App\User;
use Auth;
use Illuminate\Http\Request;

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

        $new_vehicle = request()->validate([
            'maker'=>['required','min:3'],
            'model'=>['required'],
            'year'=>['required','min:4','max:4']

        ]);


        $new_vehicle['user'] = auth()->id();

        $username = User::find(auth()->id())->username;

        Vehicle::create($new_vehicle);

        return view('/my-car');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        if(Auth::check()){

            $user_vehicle = Vehicle::where('user',auth()->id())->get();

//            return  $user_vehicle;

            return view('/my-car',compact('user_vehicle'));

        }else{


            return view('/');

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
