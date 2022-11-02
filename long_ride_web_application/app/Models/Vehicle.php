<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicle';
    protected $primaryKey = 'vehicleId';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'vehicleNumber',
        'vehicleType',
        'company',
        'created_at',
        'updated_at',
    ];
}
