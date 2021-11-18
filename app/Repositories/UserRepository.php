<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserData;
use App\Models\Notification;
use App\Models\Reservation;
use App\Models\Contact;
use App\Models\Photo;
use App\Models\Event;
use App\Interfaces\UserRepositoryInterface;
use App\Enums\UserRole;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{

    public function getProfileUser($id)
    {
        $user = User::with(['contactable', 'photos'])->find($id);

        if($user->role != (UserRole::USER) && $user->role != (UserRole::BUSINESS))
        {
            return false;
        }

        return $user;
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

    public function updateProfile($request)
    {
        $contact = [
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone
        ];

        $user = [
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        if($request->file('image') != null)
        {
            $photo = [
                'path' => $request->file('image')->store('photos')
            ];
    
            Photo::where('photoable_id', Auth::user()->id)
            ->where('photoable_type', 'App\Models\User')->update($photo);
        }
        
        Contact::where('contactable_id', Auth::user()->id)
        ->where('contactable_type', 'App\Models\User')->update($contact);

        User::find(Auth::user()->id)->update($user);

        


        return 'git';
    }
 
    public function addNotification($reservation, $text)
    {   

        $notification = new Notification;
        $notification->content = $text.': '.$reservation->user->contactable[0]->name.' '.$reservation->user->contactable[0]->surname;
        $notification->notification_type = 'App\Models\Business';
        $notification->status = false;
        $notification->notification_id = $reservation->service->business->id;

        return $notification->save();
    }

    public function setReadNotification($request)
    {
        return Notification::where('id', $request->id)->update(['status' => 1]);
    }

    public function getEvents($id)
    {
        return Event::with(['notifications'])->where('user_id', $id)->paginate(10);
    }

}
