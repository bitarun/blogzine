<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Queueable;

    protected User $user;
    protected string $password;
    protected bool $socialLogin;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, string $password, bool $socialLogin)
    {
        $this->user = $user;
        $this->password = $password;
        $this->socialLogin = $socialLogin;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new WelcomeMail($this->user, $this->password, $this->socialLogin));
    }
}
