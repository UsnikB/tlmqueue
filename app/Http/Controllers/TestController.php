<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TestController extends Controller
{
    public function list_doctors(){
        $results = DB::table('doctors')->get();
        return response()->json($results);
    }

    public function reciever(Request $request){
        $input = $request->all();
        return response()->json($input);
    }
}