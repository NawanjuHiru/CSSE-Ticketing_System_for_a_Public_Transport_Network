<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;

class InspectorApiController extends Controller
{
    /**
     * Retrive all passengers from the storage
     */
    public function getAllPassengers(){
        $data = Passenger::get();
        return response()->json($data);
    }

    /**
     * Retrive a spesific passengers from the storage
     */
    public function getSinglePassenger(){
        $data = Passenger::where('passenger_id',1)->get();
        return response()->json($data);
    }
}
