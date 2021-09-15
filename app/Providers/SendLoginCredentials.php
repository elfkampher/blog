<?php

namespace App\Providers;

use App\Providers\UserWasCreated;
use App\Mail\LoginCredentials;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLoginCredentials
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        Mail::to($event->user)->queue(
            new LoginCredentials($event->user, $event->password)
        );
    }
}
