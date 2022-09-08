<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Crew;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        "old_password",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


   /**
    * Get the role associated with the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
   public function role()
   {
       return $this->belongsTo(Role::class);

   }

   /**
    * Get the crew associated with the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function crew()
    {
        return $this->hasOne(Crew::class);

    }
}
