<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $table = 'card';
    protected $primaryKey = 'cardId';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'cardName',
        'charge',
        'validity',
        'availibilty',
        'localp',
        'foreignp',
        'created_at',
        'updated_at',
    ];
}
