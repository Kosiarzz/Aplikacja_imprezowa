<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserData;
use App\Models\Notification;
use App\Models\Reservation;
use App\Interfaces\UserRepositoryInterface;

use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{

    public function getProfileUser($id)
    {
        return User::with(['contactable', 'photos'])->find($id);
    }

    public function getLikeableUser($id)
    {
        return User::with(['businesses'])->find($id);
    }

    public function getUserNotifications($request)
    {
        return Notification::with(['notification'])
        ->where('notification_id', $request->user()->id)
        ->where('notification_type','App\Models\User')->get();
    }

    public function getReservations($id)
    {
        return Reservation::where('user_id', $id)->get();
    }

    public function getReservation($id)
    {
        return Reservation::find($id);
    }

    public function deleteReservation(Reservation $reservation)
    {
        return $reservation->delete();
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
