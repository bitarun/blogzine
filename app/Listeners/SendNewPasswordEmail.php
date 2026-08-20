<?php

namespace App\Listeners;

use App\Events\PasswordChanged;
use App\Jobs\SendNewPasswordEmailJob;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNewPasswordEmail
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
    public function handle(PasswordChanged $event): void
    {
        SendNewPasswordEmailJob::dispatch($event->user, $event->password);
    }
}
