<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $table = 'route';
    protected $primaryKey = 'routeId';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'routeNo',
        'startPoint',
        'endpoint',
        'mode',
        'price',
        'status',
        'created_at',
        'updated_at',
    ];
}
