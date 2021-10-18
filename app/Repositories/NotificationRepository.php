<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository
{
   
    public function getNotifications($id, $type)
    {
        return Notification::with(['notification'])
        ->where('notification_id', $id)
        ->where('notification_type',$type)->get();
    }

    public function addNotification($reservation, $text)
    {   

        $notification = new Notification;
        $notification->content = $text.': '.$reservation->user->contactable[0]->name.' '.$reservation->user->contactable[0]->surname;
        $notification->notification_type = 'App\Models\Business';
        $notification->status = false;
        $notification->notification_id = $reservation->room->business->id;

        return $notification->save();
    }

    public function setReadNotification($request)
    {
        return Notification::where('id', $request->id)->update(['status' => 1]);
    }

}
