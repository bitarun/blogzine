<?php

namespace App\Jobs;

use App\Mail\NewPasswordMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendNewPasswordEmailJob implements ShouldQueue
{
    use Queueable;

    public $user;
    public $password;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new NewPasswordMail($this->user, $this->password));
    }
}
