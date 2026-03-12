<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        ]);
     }
}
