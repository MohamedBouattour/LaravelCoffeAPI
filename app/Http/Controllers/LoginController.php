<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Contoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facade\Auth;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;

class LoginController extends Controller
{
    public function login (Request $request){
        $validator = Validator::make($request -> all(),[
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator -> fails() ) {
            return Response::json($validator->errors());
        }
        $credential = $request->only('email','password');
        try {
            if (! $token=JWTAuth::attempt($credential)) {
                return Response::json(['error'=>'invalide'],[401]);
            }
        } catch ( JWTException $ex){
            return Response::json(['error'=>'erreur au serveur'],[500]);
        }
        return Response::json(compact('token'));
    }
}
