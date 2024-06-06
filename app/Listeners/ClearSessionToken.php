<?php

namespace App\Listeners;

use App\Events\SessionExpired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearSessionToken
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
     * @param  \App\Events\SessionExpired  $event
     * @return void
     */
     public function handle(SessionExpired $event)
{
    $user = $event->user;
    $user->session_token = null;
    $user->save();
}

}