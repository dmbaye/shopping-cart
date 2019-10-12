<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function getUserName()
    {
        return $this->name;
    }
}
