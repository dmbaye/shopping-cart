<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'customer_id');
    }

    public function getUserName()
    {
        return $this->name;
    }
}
