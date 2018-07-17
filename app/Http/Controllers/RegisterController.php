<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Contoller;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;


class RegisterController extends Controller
{
    public function register (Request $request){
        $validator = Validator::make($request -> all(),[
            'email' => 'required|string|email|max:255|unique:users',
            'username'=> 'required|unique:users',
            'password'=> 'required'
        ]);

        if ($validator -> fails() ) {
            return Response::json($validator->errors());
        }

        User::Create([
            'username' => $request->get('username'),
            'tel'=> $request->get('tel'),
            'myreferal'=> $request->get('myreferal'),
            'mykey'=> bcrypt($request->get('username')),
            'email'=> $request->get('email'),
            'password'=> bcrypt($request->get('password')) 
        ]);

        $user = User::first();
        $token = JWTAuth::fromUser($user);
        return Response::json(compact('token'));
        
    }
}
