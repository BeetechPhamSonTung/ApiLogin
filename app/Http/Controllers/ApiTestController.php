<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiTestController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function register(Request $request){
        $user = $this->user->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        return response()->json([
            'status'=> 200,
            'message'=> 'User created successfully',
            'data'=>$user
        ]);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        try {
            $token = JWTAuth::attempt($credentials);
            if(!$token) {
                response()->json(['invalid_email_or_password', 422]);
            }
        } catch (JWTException $e) {
            return response()->json(['failed_to_create_token', 500]);
        }
        return response()->json(compact('token'));
    }


    public function  getUserInfo(Request $request){
        $user = User::all();
       // $user = JWTAuth::toUser($request->token);
        return response()->json(['data' => $user]);
    }
}
