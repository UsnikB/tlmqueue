<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PharmacyController extends Controller
{
    public function ptoken_add(Request $request){
        $token = $request->input('token');
        $counter_id = $request->input('counter_id');
        $ldate = date('Y-m-d H:i:s');
        DB::table('ptokens')
        ->where('counter_id','=', $counter_id)
        ->update(['token' => $token]);
        return response()->json('The Token Has been Added');
    }

    public function ptoken_get(Request $request){
        $counter_id = $request->input('counter_id');
        $token = DB::table('ptokens')->select('token')->orderBy('created_at', 'DESC')->where('counter_id', '=', $counter_id)->get()->take(1);
        if($token->isEmpty()){
            return "No Tokens Yet";
        }
        return $token[0]->token;
        // return $token;
    }
}
