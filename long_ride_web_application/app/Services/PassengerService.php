<?php

namespace App\Services;
use App\Models\Passenger;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PassengerService
{
    public function getAllPassengers($data)
    {
        $result = Passenger::when(isset($data['first_name']) && $data['first_name'] != '', function($q) use($data) {
            return $q->where('passenger.first_name', $data['first_name']);
        })
        ->when(isset($data['last_name']) && $data['last_name'] != '', function($q) use($data) {
            return $q->where('passenger.last_name', $data['last_name']);
        })
        ->when(isset($data['type']) && $data['type'] != '', function($q) use($data) {
            return $q->where('passenger.type', $data['type']);
        })
        ->orderBy('passenger_id','DESC')
        ->get();

        return $result;

    }

    public function getPassengers($type)
    {
        $result = Passenger::when(!empty($type) && $type != '', function($q) use($type){
            $q->where('passenger.type',$type);
        })
        ->orderBy('passenger_id','DESC')
        ->get();

        return $result;

    }

    public function getPassengersByDate($data)
    {
        $result = Passenger::when(isset($data['from']) && $data['from'] != '', function($q) use($data) {
            return $q->where(DB::raw("date(passenger.updated_at)"),'>=', Carbon::createFromFormat('m/d/Y',$data['from'])->format('Y-m-d'));
        })
        ->when(isset($data['to']) && $data['to'] != '', function($q) use($data) {
            return $q->where(DB::raw("date(passenger.updated_at)"),'<=',  Carbon::createFromFormat('m/d/Y',$data['to'])->format('Y-m-d'));
        })
        ->get();

        return $result;
    }
}

?>
