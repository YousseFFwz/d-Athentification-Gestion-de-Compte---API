<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     public function registre(Request $request){

        $request->validate([
            'name' => 'required|string' ,
            'email' => 'required|email|unique:users' ,
            'password' => 'required|string' ,
        ]) ;
        
         $user = User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => $request->password ,
        ]);

        $token = $user->createToken('token')->plainTextToken ;

        return response()->json([
            'status' => "succes" ,
            'message' => "create user to database" ,
            'data' => $user ,
            'token' => $token
        ],201);
     }


     public function login(Request $request){
         
      $validate = $request->validate([
         'email' => 'email|required' ,
         'password' => 'required|string' ,
      ]) ;

    
       if(!Auth::attempt($validate)){
         return response()->json([
            'status' => 'erorr' ,
            'message' => 'email or password field' ,
         ],422);
       }

       $user = Auth::user();
       $token = $user->createToken('token')->plainTextToken ;
       $dto = new UserDTO($user->id,$user->name,$user->email);
       
       return response()->json([
           'status' => 'success' ,
           'message' => 'login successfully' ,
           'data' => $dto ,
           'token' => $token
       ],200);
     }

     public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'suceess',
            'message' => 'logout successfully',
        ]);
     }
}
