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
        return User::with(['businesses' ])->find($id);
    }

    public function getUserNotifications($request)
    {
        return Notification::with(['notification'])
        ->where('notification_id', $request->user()->id)
        ->where('notification_type','App\Models\User')->get();
    }

    public function updateProfile($request)
    {
        if(!is_null($request->name))
        {
            $contact = [
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone
            ];

            
            Contact::where('contactable_id', Auth::user()->id)
            ->where('contactable_type', 'App\Models\User')->update($contact);
        }

        if(!is_null($request->email))
        {
            $user = [
                'email' => $request->email, 
            ];
            
            if(Hash::check($request->password, Auth::user()->password))
            {
                User::find(Auth::user()->id)->update($user);
            }
        }

        if(!is_null($request->actualPassword))
        {
            $password = [
                'password' => Hash::make($request->password), 
            ];
            
            if(Hash::check($request->actualPassword, Auth::user()->password))
            {
                User::find(Auth::user()->id)->update($password);
            }
        }

        if($request->file('image') != null)
        {
            $path = $request->file('image')->store('photos');
            session(['avatar' => $path]);

            Photo::updateOrCreate([
                'photoable_id' => Auth::user()->id,
                'photoable_type' => 'App\Models\User',
                'path' => $path,
            ]);
        }
    }

    public function deleteAccount()
    {
        return User::find(Auth::user()->id)->delete();
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
        return Event::with(['notifications','category'])->where('user_id', $id)->where('date_event','>', date("Y-m-d"))->paginate(9);
    }

    public function getEndEvents($id)
    {
        return Event::with(['notifications','category'])->where('user_id', $id)->where('date_event','<', date("Y-m-d"))->paginate(9);
    }

}
