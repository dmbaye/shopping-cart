<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'image', 'price', 'stock',
    ];

    public $quantity = null;

    public function hasLowStock()
    {
        if ($this->outOfStock()) {
            return false;
        }

        return (bool) ($this->stock <= 5);
    }

    public function outOfStock()
    {
        return $this->stock === 0;
    }

    public function inStock()
    {
        return $this->stock >= 1;
    }

    public function hasStock(int $quantity)
    {
        return $this->stock >= $quantity;
    }

    public function order()
    {
        return $this->belongsToMany('App\Models\Order', 'orders_products')
            ->withPivot('quantity');
    }
}
