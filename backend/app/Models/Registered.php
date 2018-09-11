<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registered extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'address', 'password', 'remember_token',
    ];
}
