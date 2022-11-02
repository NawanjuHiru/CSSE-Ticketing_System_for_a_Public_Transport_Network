<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    protected $table = 'passenger';
    protected $primaryKey = 'passenger_id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'type',
        'card_id',
        'status',
        'balance',
        'avatar_path',
        'created_at',
        'updated_at',
    ];
}
