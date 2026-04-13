<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(){
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'message' => 'list profile de user',
            'data' => $user
        ]);
    }
}
