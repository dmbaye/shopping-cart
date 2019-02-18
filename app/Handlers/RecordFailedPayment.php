<?php

namespace App\Handlers;

use App\Handlers\Contracts\HandlerInterface;

class RecordFailedPayment implements HandlerInterface
{
    public function handle($event)
    {
        $event->order->payment()->create([
            'failed' => true,
        ]);
    }
}
