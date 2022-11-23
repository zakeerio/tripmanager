<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $filelable = [
        'name','guard_name'
    ];

    /**
     * Get all of the role for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function role(): HasMany
    {
        return $this->hasMany(User::class, 'rold_id', 'id');
    }

}
