<?php

namespace App\Listeners;

use App\Events\UserCommented;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Notification;

class CommentListener
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
     * @param  UserCommented  $event
     * @return void
     */
    public function handle(UserCommented $event)
    {
        //
        $notification = new Notification;
        $notification->body = $event->comment . " was made";
        $notification->save();
    }
}
