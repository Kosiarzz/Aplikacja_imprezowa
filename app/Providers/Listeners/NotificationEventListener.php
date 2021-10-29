<?php

namespace App\Providers\Listeners;

use App\Providers\Events\NotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use App\Models\Notification;

class NotificationEventListener
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
     * @param  NotificationEvent  $event
     * @return void
     */
    public function handle(NotificationEvent $event)
    {
        Notification::create([
            'notification_id' => $id = $event->reservation->event_id,
            'notification_type' => 'App\Models\Event',
            'content' => 'Rezerwacja w '.$event->reservation->service->business->title.' została zaakceptowana.',
            'content_type' => 'good',
            'status' => 0,
            'crated_at' => now(),
        ]);

    }
}
