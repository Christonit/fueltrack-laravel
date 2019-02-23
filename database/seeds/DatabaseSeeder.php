php artisan make<?php

use Illuminate\Database\Seeder;

use App\User;
use App\vehicle;
use App\vehicle_performance;
use Illuminate\Support\Facades\Hash;
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

    }
}
