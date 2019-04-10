<?php

use Illuminate\Database\Seeder;

use App\User;
use App\vehicle;
use App\vehicle_performance;
use App\expenses;
use App\vehicle_maintenance;
use Illuminate\Support\Facades\Hash;
use App\FuelPrices;
//use Illuminate\Support\Facades\Validator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::insert([
            'username' => 'christonit',
            'email' => 'christopher.sant@outlook.com',
            'password' => Hash::make('123456ch'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_At'=> date("Y-m-d H:i:s"),

        ]);


        vehicle::insert([
            'user' => '1',
            'maker' => 'Mazda',
            'model' =>'6',
            'year' =>'2015',
            'usage_years' =>'3',
            'fueltype' =>'Gasoline',
            'acquisition_date' =>'2019-02-06',
            'init_miles' =>'56000',
            'meassurement_unit' =>'MILES',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_At'=> date("Y-m-d H:i:s"),
        ]);



        vehicle_performance::insert([
            'vehicle' => '1',
            'City_MPG' =>'29.84',
            'Highway_MPG' =>'37.00',
            'Avg_MPG' =>'25.94',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_At'=> date("Y-m-d H:i:s"),

        ]);

        vehicle_maintenance::insert([
            "vehicle" => "1",
            "maintenance_service" => "Wheel change",
            "due_moment" => "Specific distance",
            "status" => "1",
            "tracked_distance" => "5000",
            "current_distance" => "337",
            'created_at' => "2019-01-01 00:00:00",
            'updated_At'=> "2019-02-27 22:51:19",
        ]);


        vehicle_maintenance::insert([
            "vehicle" => "1",
            "maintenance_service" => "Paint job",
            "due_moment" => "Inmediate",
            "status" => "1",
            'created_at' => "2019-02-28 00:00:00",
            'updated_At'=> "2019-02-27 21:18:13",
        ]);

        vehicle_maintenance::insert([
            "vehicle" => "1",
            "maintenance_service" => "Scheduled maintenance",
            "due_moment" => "Specific distance",
            "status" => "1",
            "tracked_distance" => "5000",
            "current_distance" => "571",
            'created_at' => "2017-01-01 04:00:56",
            'updated_At'=> "2019-02-27 22:51:19",
        ]);


        vehicle_maintenance::insert([
            "vehicle" => "1",
            "maintenance_service" => "Horn check",
            "due_moment" => "Specific date",
            "status" => "1",
            "final_date" => "2019-03-01",
            "tracked_distance" => "5000",
            "current_distance" => "571",
            'created_at' => "2019-02-27 21:18:13",
            'updated_At'=> "2019-02-27 21:18:13",
        ]);

        expenses::insert([
            "vehicle"=>"1",
            "Galons"=>"2",
            "FuelType"=>"Gasolina Premium",
            "Current_fuel_price"=>"225.30",
            "Date"=>"2018-02-17",
            "created_at"=>"2018-02-17 04:00:56",
            "updated_at"=>"2018-02-17 04:00:56",
        ]);


        expenses::insert([
            "vehicle"=>"1",
            "Galons"=>"2",
            "FuelType"=>"Gasolina Premium",
            "Current_fuel_price"=>"230.10",
            "Date"=>"2018-11-15",
            "created_at"=>"2018-11-15 04:00:56",
            "updated_at"=>"2018-11-15 04:00:56",
        ]);


        expenses::insert([
            "vehicle"=>"1",
            "Galons"=>"1",
            "FuelType"=>"Gasolina Premium",
            "Current_fuel_price"=>"208.40",
            "Date"=>"2019-01-15",
            "created_at"=>"2019-01-15 04:00:56",
            "updated_at"=>"2019-01-15 04:00:56",
        ]);


        expenses::insert([
            "vehicle"=>"1",
            "Galons"=>"3",
            "FuelType"=>"Gasolina Premium",
            "Current_fuel_price"=>"214.40",
            "Date"=>"2019-01-22",
            "created_at"=>"2019-01-22 04:00:56",
            "updated_at"=>"2019-01-22 04:00:56"
        ]);

        expenses::insert([
            "vehicle"=>"1",
            "Galons"=>"4",
            "FuelType"=>"Gasolina Premium",
            "Current_fuel_price"=>"214.40",
            "Date"=>"2019-02-01",
            "created_at"=>"2019-02-01 04:00:56",
            "updated_at"=>"2019-02-01 04:00:56",
        ]);


        expenses::insert([
            "vehicle"=>"1",
            "Galons"=>"5",
            "FuelType"=>"Gasolina Premium",
            "Current_fuel_price"=>"214.40",
            "Date"=>"2019-02-07",
            "created_at"=>"2019-02-07 04:00:56",
            "updated_at"=>"2019-02-07 04:00:56",
        ]);


        FuelPrices::insert([
            'gasolina_premium'=>'	238.40	',
            'gasolina_regular'=>'223.00	',
            'gasoil_optimo'=>'194.50',
            'gasoil_regular'=>'180.20',
            'kerosene'=>'169.60',
            'glp'=>'103.10',
            'gnv'=>'28.97',
            'start_of_week'=>'2019-03-30',
            'end_of_week'=>'2019-04-05',
            'country'=>'DR'
        ]);

    }
}
