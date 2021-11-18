<?php

namespace App\Repositories;

use App\Models\Notification;


class NotificationRepository
{
   
    public function getNotifications($id, $type)
    {
        return Notification::with(['notification'])
        ->where('notification_id', $id)
        ->where('notification_type', $type)->get();
    }

    public function addNotificationUser($id, $content)
    {   
        $notification = new Notification;
        $notification->content = $content;
        $notification->notification_type = 'App\Models\User';
        $notification->status = false;
        $notification->notification_id = $id;

        return $notification->save();
    }

    public function addNotificationBusiness($id, $content, $content_type)
    {   
        $notification = new Notification;
        $notification->content = $content;
        $notification->content_type = $content_type;
        $notification->notification_type = 'App\Models\Business';
        $notification->created_at = now();
        $notification->status = false;
        $notification->notification_id = $id;

        return $notification->save();
    }

    public function addNotificationEvent($id, $content, $content_type)
    {   
        $notification = new Notification;
        $notification->content = $content;
        $notification->content_type = $content_type;
        $notification->notification_type = 'App\Models\Event';
        $notification->created_at = now();
        $notification->status = false;
        $notification->notification_id = $id;

        return $notification->save();
    }

    public function setReadNotification($request)
    {
        return Notification::where('id', $request->id)->update(['status' => 1]);
    }

}
