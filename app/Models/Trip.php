<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'departuredate',
        'departuretime',
        'crewnotes',
        'boatname',
        'destination',
        'duration',
        'archived',
        'crewneeded',
        'cost',
        'balance',
        'sent_notice',
        'passengers',
       
    ];
    public function tripcrews()
    {
        return $this->hasMany(Tripcrew::class,  'tripnumber');
    }


}
