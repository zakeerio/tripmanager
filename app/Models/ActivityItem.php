<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'activityname',
        'activitytype',
        'activitycapacity',
        'activitypicture',
        'minimumcrew',
        'rgbcolor',
       
    ];
}
