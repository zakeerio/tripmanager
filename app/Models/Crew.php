<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Role;
use App\Models\Crew;

class Crew extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'emailaddress',
        'firstaid',
        'rya',
        'cba',
        'iwa',
        'keyholder',
        'skipper',
        'mobile',
        'secondarynumber',
        'archived',
        'pswd',
        'privilege',
        'username',
        'optin',
        'faexpire',
        'boatpreference',
        'traveltime',
        'memnumber',
        'lastlogin',
        'suspended',
        'user_id',
    ];


    /**
     * Get the user that owns the Crew
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        return $this->hasOne(User::class,  'id', 'user_id');
    }
}
