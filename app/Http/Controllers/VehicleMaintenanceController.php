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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

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

        $service = request()->all();


        $validator =  Validator::make($service,[
            'maintenance_service'=>['required'],
            'due_moment'=>['required']
        ]);

        if($validator->fails()){
            $errors['Errors'] = $validator->messages();
            return $errors;
        }


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






        return "true";



        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //

        if(Auth::check()){
            $vehicle_id = vehicle::userVehicle();
            $m_s_performed = vehicle_maintenance::getPerformedMaintenance($vehicle_id);
            return $m_s_performed;
    
        }else{
            return 'Not autorized to see this information.';
        }
       
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

        // return view('vehicle.maintenance-history-template',compact('performed'));
    }


    public  function latestAdded(){

        $maintenances = vehicle_maintenance::latestMaintenanceAdded();

        // return view('vehicle.maintenance-template',compact('maintenances'));
        return $maintenances;
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

    public function activeMaintenances(){

        $vehicle_id = vehicle::userVehicle();
        $date_pending =  vehicle_maintenance::where([
            ['vehicle',$vehicle_id],
            ['status',1],
            ['due_moment', 'Specific date']
        ])
        ->whereNull('days_overdue')
        ->orderBy('created_at','DESC')
        ->get();


        $distance_pending =  vehicle_maintenance::where([
            ['vehicle',$vehicle_id],
            ['status',1],
            ['due_moment', 'Specific distance']
            ])
            ->whereNull('overdue_distance')
            ->orderBy('created_at','DESC')
            ->get();


        $distance_date_overdue = vehicle_maintenance::where([['vehicle',$vehicle_id],['status',1]])
            ->whereIn('due_moment',['Specific distance','Specific date'])
            ->whereNotNull('days_overdue')
            ->orWhereNotNull('overdue_distance')->orderBy('created_at','DESC')
            ->get();



        $due_inmediate = vehicle_maintenance::where([['vehicle',$vehicle_id],['status',1]])->where('due_moment','Inmediate')->orderBy('created_at','DESC')->get();

        $maintenance = collect();

        $maintenance = $maintenance->concat($due_inmediate)->concat($distance_date_overdue)->concat($date_pending)->concat($distance_pending);
        
        return $maintenance;

    }
    
    public function maintenancesExpenses(){

        $vehicle_id = vehicle::userVehicle();
        return MaintenancesServicesPerformed::getMaintenancesExpenses($vehicle_id);

    }
    public function dueMomentCalculator(){

    
        foreach($maintenance as $maintenances){

            if($maintenances->due_moment == 'Specific distance'){

                $galons = expenses::galonsSinceDate($maintenances->created_at,$vehicle_id);


                vehicle_maintenance::where('vehicle','=',$vehicle_id)
                    ->where('id', '=',$maintenances->id)
                    ->where('due_moment', '=','Specific distance')
                    ->where('status','=','1')
                    ->update(['current_distance' => ($avg_performance * $galons) ]);


            }elseif($maintenances->due_moment == 'Specific date'){

                //Final date for maintenance
                $fDate = date_create($maintenances->final_date);

                //Current date
                $cDate = date_create( date("Y-m-d") );

                $days_overdue = date_diff($cDate,$fDate)->format("%R%a");

                if($days_overdue<0){

                    $days_overdue = ($days_overdue * -1);

                    vehicle_maintenance::where('vehicle','=',$vehicle_id)
                        ->where('id', '=',$maintenances->id)
                        ->where('due_moment', '=','Specific date')
                        ->where('status','=','1')
                        ->update(['days_overdue' => $days_overdue]);

                }else{

                    $maintenances['days_left'] = $days_overdue;
                }

            }


        }
    }
}
