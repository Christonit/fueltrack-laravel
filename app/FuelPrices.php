<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class FuelPrices extends Model
{
    //

    protected function getCurrentWeek(){

        $en = Carbon::now('America/New_York')->locale('en_US');

        $start = $en->startOfWeek(Carbon::SATURDAY)->format('Y-m-d H:i');
        $end = $en->endOfWeek(Carbon::FRIDAY)->format('Y-m-d H:i');

        $week= array();

        $week['actual']= $en;
        $week['start']= $start;
        $week['end']= $end;

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

        $fuelList['Gasolina Regular'] = substr($regularGas[0],4);
        $fuelList['Gasolina Premium'] = substr($premiumGas[0],4);
        $fuelList['Gasoil Optimo'] = substr($gasoilOpt[0],4);
        $fuelList['Gasoil Regular'] = substr($gasoilReg[0],4);
        $fuelList['Kerosene'] = substr($kerosene[0],4);
        $fuelList['Gas Licuado de Petróleo (GLP)'] = substr($glp[0],4);
        $fuelList['Gas Natural Vehicular (GNV)'] = substr($gnv[0],4);

        return $fuelList;
    }
}
