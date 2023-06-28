<?php

namespace App\Http\Controllers;
use App\integration\Facebook;
use Illuminate\Http\Request;
use App\Models\Integration;

class IntegrationsSocialNetworkController extends Controller
{
    //
    

    public function authLogin(Request $request){
        $auth = Integration::integrationAuthLogin($request);

        if($auth==false) return respuestasJson(true,'200','no existe la integracion: '.$request->name_app);

        return respuestasJson(false,'200','success',$auth);
    }


    // public function login()
    // {
    //     $auth = Integration::integrationAuthLogin($request);

    //     if($auth==false) return respuestasJson(true,'200','no existe la integracion: '.$request->name_app);

    //     return respuestasJson(false,'200','success',$auth);
    // }

    // public function callback(Request $request)
    // {
    //     return response()->json(['message' => 'Callback from Facebook received'.$request->name_app]);
    // }
   }
