<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) 
    {
        $validator=Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required',
        'password'=>'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'message'=>$validator->errors()
            ]);
        }

        $user=new User();
        $user->name=$request->name;
        $user->email = $request->email;
        $user->password=Hash::make($request->password);
        $user->save();

        $apiToken=$user->createToken('bearer_token')->plainTextToken;

        return response()->json([
            'token'=>$apiToken,
            'messsage'=>"Registered successfully."
        ]);
    }

    function login(Request $request) 
    {

          $validator=Validator::make($request->all(),[
        'email'=>'required',
        'password'=>'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'message'=>$validator->errors()
            ]);
        }

        $cred=request(['email','password']);

        if(!\Auth::attempt($cred)){
            return response()->json([
                'messsage'=>"Your credentials do not match.",
            ]);
        }
        $apiToken=User::where('email',$request->email)->first()->createToken('bearer_token')->plainTextToken;

        return response()->json([
            'token'=>$apiToken,
            'messsage'=>"Logged in successfully."
        ]);
    }
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->tokens()->delete();
            return response()->json([
                'message' => "Logout successfully.",
            ]);
        } else {
            return response()->json([
                'message' => "No authenticated user found.",
            ], 401); 
        }
    }
}
