<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TimeTable extends Model
{
    use HasFactory;
    protected $table = 'timetable';
    protected $primaryKey = 'timetableId';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'routeId',
        'day',
        'company',
        'vehicleId',
        'arrivaltime',
        'depaturetime',
        'created_at',
        'updated_at',
    ];

    protected function getTimeTables($data,$routeId){

        $res =  TimeTable::when(isset($data['timetableId']) && $data['timetableId'] != '', function($q) use($data) {
            return $q->where('timetable.timetableId', $data['timetableId']);
        })
        ->when(isset($data['day']) && $data['day'] != '', function($q) use($data) {
            return $q->where('timetable.day', $data['day']);
        })
        ->where('routeId',$routeId)
        ->orderBy('timetableId','desc')

        ->get();

        return $res;
    }
}
