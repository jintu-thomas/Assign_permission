<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validation = Validator::make($request->all(),[

        'name' =>'required',
        'email' =>'required|email|unique:users',
        'password' => 'required',
        'c_password' => 'required|same:password',

        ]);

        if($validation->fails()) {
            return response()->json($validation->errors(),202);
        }
        

        $data = $request ->all();

        
        $data['password'] = bcrypt($data['password']);
        $user =User::create($data);

        $resArr = [];

        $resArr['token']=$user->createToken('api-application')->accessToken;
        $resArr['name']=$user->name;
        return response()->json($resArr,200);
    }



    public function login(Request $request)
    {
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
            ])){
        
                $user = Auth::user();
                $resArr = [];
                $resArr['token']=$user->createToken('api-application')->accessToken;
                $resArr['name']=$user->name;
                return response()->json($resArr,200);
        }else{
            return  response()->json(['error'=>'Unautherized Access'],203);
        }
    }
    
    public function logout(Request $request)
    {
    
        $token = $request->user()->token();
        $token->revoke();
        $response = ["message" => "you have successfully logout"];
        return response($response,200);
    }
}
