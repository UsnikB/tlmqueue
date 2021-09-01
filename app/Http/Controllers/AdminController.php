<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request){
        $user = $request->input('user');
        $password = $request->input('password');
        if ($user == 'admin'){
            if ($password == 'admin123'){
                $res = DB::table('doctors')->get();
                if($res->isEmpty()){
                    return "2";
                }
                return $res;
            }
            else
                return 'false';
        }
        else
            return 'false';
    }

    public function add(Request $request){
        $doctor = $request->input('doctor');
        $room_number = $request->input('room_number');
        $ldate = date('Y-m-d H:i:s');
        DB::table('doctors')->insert([
            'doctor' => $doctor,
             'room_number' => $room_number,
             'created_at' => $ldate,
             'updated_at' => $ldate
        ]);

        $doctor_id = DB::table('doctors')->select('id')->where('doctor','=',$doctor)->get();
        DB::table('tokens')->insert([
            'token' => 'CLOSED',
             'doctor_id' => $doctor_id[0]->id,
             'created_at' => $ldate,
             'updated_at' => $ldate
        ]);
        $res = DB::table('doctors')->get();;
        return $res;
    }
    public function delete(Request $request){
        $id = $request->input('id');
        $deleted = DB::table('doctors')->where('id', '=', $id)->delete();
        $deleted = DB::table('tokens')->where('doctor_id', '=', $id)->delete();
        $res = DB::table('doctors')->get();
        if($res->isEmpty()){
            return "2";
        }
        return $res;
    }

    public function list_doctors(){
        $results = DB::table('doctors')->get();
        if($results->isEmpty()){
            return "2";
        }
        return response()->json($results);
    }

    public function update(Request $request){
        $id = $request->input('id');
        $room_number = $request->input('room_number');
        $affected = DB::table('doctors')
            ->where('id', $id)
            ->update(['room_number' => $room_number]);
        $res = DB::table('doctors')->get();
        if($res->isEmpty()){
            return "2";
        }
        return $res;
    }
    public function token_add(Request $request){
        $token = $request->input('token');
        $doctor_id = $request->input('doctor_id');
        $ldate = date('Y-m-d H:i:s');
        DB::table('tokens')
        ->where('doctor_id','=', $doctor_id)
        ->update(['token' => $token]);
        return response()->json('The Token Has been Added');
    }
    public function token_get(Request $request){
        $doctor_id = $request->input('doctor_id');
        $token = DB::table('tokens')->select('token')->orderBy('created_at', 'DESC')->where('doctor_id', '=', $doctor_id)->get()->take(1);
        if($token->isEmpty()){
            return "No Tokens Yet";
        }
        return $token[0]->token;
        // return $token;
    }
}