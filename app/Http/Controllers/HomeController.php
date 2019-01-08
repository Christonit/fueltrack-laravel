<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function welcome()
     {

         return view('/welcome');
     }

    public function index()
    {

      $usuarios = User::where('id',auth()->id())->get();

      return view('/home',compact('usuarios'));
    }

    public function welcome2(User $usuarios)
    {


        return view('/welcome2',compact('usuarios'));
    }


}
