<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use Goutte;
use \DateTimeZone;


class FuelPrices extends Model
{
    //

    protected  $fillable = [
        'gasolina_premium',
        'gasolina_regular',
        'gasoil_optimo',
        'gasoil_regular',
        'kerosene',
        'glp',
        'gnv',
        'start_of_week',
        'end_of_week',
        'country'];

    protected  $guarded = [];


    protected function getCurrentWeek(){

        $en = Carbon::now();
//        $actual = $en->format('Y-m-d H:i:s');

        $start = $en->startOfWeek(Carbon::SATURDAY)->format('Y-m-d H:i');
        $end = $en->endOfWeek(Carbon::FRIDAY)->format('Y-m-d H:i');

        $week= array();

        $week['start_of_week']= $start;
        $week['end_of_week']= $end;

        return $week;


    }

    protected function getFuelPrices(){

        $crawler = Goutte::request('GET', 'https://micm.gob.do/');

        $premiumGas = $crawler->filter('div.moduletable:nth-child(8) > table:nth-child(2) > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(2)')->each(function ($node) {
            return $node->text();
        });

        $regularGas = $crawler->filter('div.moduletable:nth-child(8) > table:nth-child(2) > tbody:nth-child(2) > tr:nth-child(2) > td:nth-child(2)')->each(function ($node) {
            return $node->text();
        });

        $gasoilOpt = $crawler->filter('div.moduletable:nth-child(8) > table:nth-child(2) > tbody:nth-child(2) > tr:nth-child(3) > td:nth-child(2)')->each(function ($node) {
            return $node->text();
        });

        $gasoilReg = $crawler->filter('div.moduletable:nth-child(8) > table:nth-child(2) > tbody:nth-child(2) > tr:nth-child(4) > td:nth-child(2)')->each(function ($node) {
            return $node->text();
        });

        $kerosene = $crawler->filter('div.moduletable:nth-child(8) > table:nth-child(2) > tbody:nth-child(2) > tr:nth-child(5) > td:nth-child(2)')->each(function ($node) {
            return $node->text();
        });

        $glp = $crawler->filter('div.moduletable:nth-child(8) > table:nth-child(2) > tbody:nth-child(2) > tr:nth-child(6) > td:nth-child(2)')->each(function ($node) {
            return $node->text();
        });

        $gnv = $crawler->filter('div.moduletable:nth-child(8) > table:nth-child(2) > tbody:nth-child(2) > tr:nth-child(6) > td:nth-child(2)')->each(function ($node) {
            return $node->text();
        });

        $fuelList = array();

        //Gasolina Regular
        $fuelList['gasolina_regular'] = substr($regularGas[0],4);

        //Gasolina Premium
        $fuelList['gasolina_premium'] = substr($premiumGas[0],4);

        //Gasoil Optimo
        $fuelList['gasoil_optimo'] = substr($gasoilOpt[0],4);

        //Gasoil Regular
        $fuelList['gasoil_regular'] = substr($gasoilReg[0],4);

        //Kerosene
        $fuelList['kerosene'] = substr($kerosene[0],4);

        //Gas Licuado de Petróleo (GLP)
        $fuelList['glp'] = substr($glp[0],4);

        //Gas Natural Vehicular (GNV)
        $fuelList['gnv'] = substr($gnv[0],4);

        return $fuelList;
    }
}
