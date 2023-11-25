<?php

namespace App\Listeners;

use App\Events\UpdateUserAmount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserAmountListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UpdateUserAmount $event): void
    {
        $user = $event->user;
        $amount = $user->products()->sum('price');
        $user->update(['amount' => $amount]);
    }
}
