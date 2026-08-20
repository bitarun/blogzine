<?php

namespace App\Listeners;

use App\Events\Subscribed;
use App\Jobs\SendSubscribeEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSubscribeEmail
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
    public function handle(Subscribed $event): void
    {
        SendSubscribeEmailJob::dispatch($event->user);
    }
}
