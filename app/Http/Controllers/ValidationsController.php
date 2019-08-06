<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;


class ValidationsController extends Controller
{
    //

    public function username(Request $request){

        $validator = Validator::make($request->all(), ['username'=>'bail|unique:users|min:6|max:20']);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        return 'success';

    }


    public function password(Request $request){

        $validator = Validator::make($request->all(), ['password' => 'required|string|min:6']);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        return 'success';

    }

    public function email(Request $request){

        $validator = Validator::make($request->all(), ['email' => 'required|string|email|max:255|unique:users']);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        return 'success';

    }


}
