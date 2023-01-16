<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tripcrew extends Model
{
    use HasFactory;
    protected $fillable =[
        'recordnumber',
        'crewcode',
        'available',
        'confirmed',
        'isskipper',
        'tripnumber',
        'notes',

    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class,  'tripnumber', 'id');
    }

}
