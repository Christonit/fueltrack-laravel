<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pageController extends Controller
{
    //
    public function home(){
      // $task =[
      //      'Hola',
      //      'Mundo',
      //      'Att: Chris'
      //    ];

         return view('home') ;
    }

    public function browse(){

         return view('home');
    }

    public function myCar(){
      $task =[
           'Hola',
           'Mundo',
           'Att: Chris'
         ];

         return view('my-car');
    }


    public function login(){

         return view('forms.login');
    }


    public function sign_up(){

         return view('forms.sign-up');
    }

    public function  addVehicle(){
      return view('forms.sign-up-vehicle');

    }

}
