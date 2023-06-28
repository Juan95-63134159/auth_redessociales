<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::all();
        // return response()->json($users);
        
        return respuestasJson(false,'200','estos son los usuarios',$users);
    }
}
