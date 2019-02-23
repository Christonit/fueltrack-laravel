<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\User as Authenticatable;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     *
     *
     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    protected $redirectTo = '/my-car';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function redirectTo()
    {

        $user =  Auth()->user()->username;

        return '/'.$user.'/my-car';



    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
