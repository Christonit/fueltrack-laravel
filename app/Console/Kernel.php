<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\FuelPrices;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        //Update fuel prices every friday at 12 pm.
//        $schedule->call(function(){
//
//            $FuelPrices = array();
//            $FuelPrices = array_merge( FuelPrices::getCurrentWeek(), FuelPrices::getFuelPrices());
//            $FuelPrices['country'] = 'DO';
//            FuelPrices::create($FuelPrices);
//
//        })->weeklyOn(5, '12:00');
//


        //Run command manually as currently there is no server.
        $schedule->call(function(){
            $FuelPrices = array();
            $FuelPrices = array_merge( FuelPrices::getCurrentWeek(), FuelPrices::getFuelPrices());
            $FuelPrices['country'] = 'DO';
            FuelPrices::create($FuelPrices);

        })->everyMinute();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
