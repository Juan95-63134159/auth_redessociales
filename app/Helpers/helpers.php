<?php
use Illuminate\Support\Facades\DB;

if(!function_exists('respuestasJson')){
    function respuestasJson($error,$code,$message='',$data=''){
        return response()->json([
            'error'=>$error,
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        ]);
    }
}


if(!function_exists('iniciarParametrosValores')){
    function iniciarParametrosValores($client_id, $integration_id){
        $result = DB::table('integrations_client')->where('client_id', $client_id)->where('integration_id', $integration_id)->get();
        if(empty($result)) return false;
        return $result;
    }
}