<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'hash', 'total', 'paid', 'address_id', 'customer_id',
    ];

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'orders_products')
            ->withPivot('quantity');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\Payment');
    }
}
