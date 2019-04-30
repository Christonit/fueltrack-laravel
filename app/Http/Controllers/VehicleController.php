<?php

namespace App\Http\Controllers;

use App\FuelPrices;
use App\MaintenancesServicesPerformed;
use App\vehicle;
use App\User;
use App\vehicle_performance;
use App\vehicle_maintenance;
use App\expenses;
use Auth;
use JavaScript;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use \Carbon\Carbon;
use DateTime;


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
            'year'=>['required','min:4','max:4'],
            'usage_years'=>['required'],
            'acquisition_date'=>['required'],
            'init_miles'=>['required'],
            'meassurement_unit'=>['required'],
            'fueltype'=>['required'],


        ]);


        $logged_user_id = auth()->id();

        $logged_user = auth()->user()->username;

        $vehicle_performance = request()->validate(['City_MPG'=>'required',
            'Avg_MPG'=>'required',
            'Highway_MPG'=>'required']);

        $new_vehicle['user'] = $logged_user_id;

        vehicle::create($new_vehicle);

        $vehicle_id = vehicle::
        where('user',$logged_user_id)
            ->value('id');

        $vehicle_performance['vehicle'] = $vehicle_id;

        vehicle_performance::create($vehicle_performance);

        return redirect('/'.$logged_user.'/my-car');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\vehicle  $vehicle
     * @return \Illuminate\Http\Responwww . way back machine . org / web /20180618212328 / http: // ocean of pdf. com/se
     */
    public function show(User $user)
    {

        $logged_user_id = auth()->id();

        $vehicle = vehicle::
        where('user',$logged_user_id)->get();




        if(Auth::check() && count($vehicle) !== 0 ){

            $curent_week_number = expenses::getVar('weekOfTheYear');
            $curent_week_date = expenses::getStartofTheWeek($curent_week_number,0)->format('y-m-d');

            $vehicle_id = vehicle::
            where('user',$logged_user_id)
                ->value('id');

            $m_s_performed = vehicle_maintenance::getPerformedMaintenance($vehicle_id);

            //Lists all services performed in a maintenance.
            $m_s_list = $m_s_performed->pluck('maintenance_service')->unique()->values();


            //Sum all cost for a given service category done in a vehicle.
            foreach ($m_s_list as $i) {

                $maintenance_expenses[] = $m_s_performed->where('maintenance_service', $i)->sum('cost');
            }

            if( $m_s_performed->count() != 0) {

                Javascript::put([
                    'm_s_category' => $m_s_list,
                    'm_s_total_cost' => $maintenance_expenses
                ]);



                $total_m_s_expenses = array_sum($maintenance_expenses);

            }else{
                $total_m_s_expenses = 0;

            }


            $vehicle_p = vehicle_performance::where('vehicle',$vehicle_id)->get();

            $maintenance =  vehicle::find($vehicle_id)->maintenances;

            //1. Gets totals of galons following a given date greater or equal than the date when a maintenance was added as active.

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


            $expenses = expenses::where('vehicle',$vehicle_id)->get()->reverse();

            $weekly_expenses = expenses::totalExpensesByWeek('gasolina_premium');



            /**/
            /**/

            //Vehicle averages

            //This week's expenses
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

            /**/
            /**/

//            $averages[] = $vehicle_averages;




            $new = $vehicle_averages['current_week'];

            $original = $vehicle_averages['last_week'];

            $vehicle_averages['increase_decrease_percentage'] = (($new - $original) / $original * 100);

//            dd($vehicle_averages);


            Javascript::put([
                'weekly_range' => $weekly_expenses['weeks'],
                'weekly_cost' => $weekly_expenses['expense']
            ]);



//            return $averages;
            return view('/my-car', compact(['vehicle','vehicle_p','expenses','maintenance','total_m_s_expenses','m_s_performed','vehicle_averages','weekly_expenses']) );

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


    public function test(){

        $logged_user_id = auth()->id();

        $vehicle_id = vehicle::
        where('user',$logged_user_id)
            ->value('id');




        return (expenses::totalGalonsGlobal($vehicle_id) * vehicle_performance::where('vehicle',$vehicle_id)->value('Avg_MPG'));

    }


}
