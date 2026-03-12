<?php

namespace App\Http\Controllers;

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

        return response()->json([
            'status' => "succes" ,
            'message' => "create user to database" ,
            'data' => $user ,
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

       return response()->json([
           'status' => 'success' ,
           'message' => 'login successfully' ,
           'data' => Auth::user() ,
       ],200);
     }
}
