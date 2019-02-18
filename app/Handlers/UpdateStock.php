<?php

namespace App\Handlers;

use App\Handlers\Contracts\HandlerInterface;

class UpdateStock implements HandlerInterface
{
    public function handle($event)
    {
        $products = $event->basket->all();

        foreach ($products as $product) {
            $product->decrement('stock', $product->quantity);
        }
    }
}
