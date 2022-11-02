<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TicketInspector extends Model
{
    use HasFactory;
    protected $table = 'ticketinspector';
    protected $primaryKey = 'ins_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'city',
        'password',
        'route',
        'avatar',
        'created_at',
        'updated_at',
    ];

    protected function getTicketInspectors($data){
        $res =  TicketInspector::when(isset($data['firstname']) && $data['firstname'] != '', function($q) use($data) {
            return $q->where('ticketinspector.firstname', $data['firstname']);
        })
        ->when(isset($data['lastname']) && $data['lastname'] != '', function($q) use($data) {
            return $q->where('ticketinspector.lastname', $data['lastname']);
        })
        ->when(isset($data['email']) && $data['email'] != '', function($q) use($data) {
            return $q->where('ticketinspector.email', $data['email']);
        })
        ->when(isset($data['phone']) && $data['phone'] != '', function($q) use($data) {
            return $q->where('ticketinspector.phone', $data['phone']);
        })
        ->when(isset($data['city']) && $data['city'] != '', function($q) use($data) {
            return $q->where('ticketinspector.city', $data['city']);
        })
     ->get();

        return $res;
    }

}

