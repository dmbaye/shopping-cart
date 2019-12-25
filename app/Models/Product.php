<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'stock',
    ];

    public $quantity = null;

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function hasLowStock(): bool
    {
        if ($this->outOfStock()) {
            return false;
        }

        return (bool) ($this->stock <= 5);
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function outOfStock(): bool
    {
        return $this->stock === 0;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function inStock(): bool
    {
        return $this->stock >= 1;
    }

    /**
     * Undocumented function
     *
     * @param integer $quantity
     * @return boolean
     */
    public function hasStock(int $quantity): bool
    {
        return $this->stock >= $quantity;
    }

    public function order()
    {
        return $this->belongsToMany('App\Models\Order', 'orders_products')
            ->withPivot('quantity');
    }
}
