<?php

namespace App\Handlers;

use App\Handlers\Contracts\HandlerInterface;

class MarkOrderPaid implements HandlerInterface
{
    public function handle($event)
    {
        $event->order->update([
            'paid' => true,
        ]);
    }
}
