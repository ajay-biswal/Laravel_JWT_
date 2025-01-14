<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|min:2|max:100',
            'email'=>'required|string|email|max:100|unique:users',
            'password'=> 'required|string|min:3'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $user =User::create([
            'name'=>$request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password)
        ]);

        return response()->json([
            'message'=>'User registered successfully',
            'user'=>$user
        ]);
    }
}
