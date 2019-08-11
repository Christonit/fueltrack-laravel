<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


class pageController extends Controller
{
    //
    public function home(){

         return view('home') ;
    }

    public function index()
    {

      $usuarios = User::where('id',auth()->id())->get();

      return view('/my-car',compact('usuarios'));
    }


    public function browse(){

         return view('home');
    }

    public function myCar(){


         return view('my-car');
    }



    public function sign_up(){


         return view('forms.sign-up');
    }

    public function  addVehicle(){

        if(Auth::check() ){
            return view('vehicle.add-vehicle');

        }else{

            return redirect('/');

        }

    }

}
