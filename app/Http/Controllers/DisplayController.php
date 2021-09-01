<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function display_doctors(){
        $latest = DB::table('doctors')
        ->join('tokens', 'doctors.id', '=', 'tokens.doctor_id')
        ->select('doctors.doctor', 'tokens.token', 'doctors.room_number', 'tokens.created_at')
        ->get();
        return $latest;
    }
    public function display_pharmacy(){
        $latest = DB::table('phar')
        ->join('ptokens', 'phar.id', '=', 'ptokens.counter_id')
        ->select('ptokens.token', 'phar.counter_number', 'ptokens.created_at')
        ->get();
        return $latest;
    }
}
