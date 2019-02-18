<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'email',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
