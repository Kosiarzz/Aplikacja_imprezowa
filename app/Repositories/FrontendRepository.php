<?php

namespace App\Repositories;

use App\Models\Business;
use App\Models\City;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Comment;
use App\Models\Notification;
use App\Interfaces\FrontendRepositoryInterface;
//use App\Models\{Business,City};
class FrontendRepository implements FrontendRepositoryInterface
{
    //Komunikacja z bazą danych

    //Pobranie danych na stronę główną
    public function getDataMainPage()
    {
        return Business::with(['city','photos','address'])->ordered()->paginate(10);
    }

    //Pobranie danych wybranej firmy
    public function getBusinessDetails($id)
    {
        return Business::with(['city','photos','comments.user','comments.photos','questionsAndAnswers','address','users.photos','rooms.photos'])->find($id);
    }

    //Wyszukanie miasta po pierwszych kilku literach
    public function getSearchCities(string $term)
    {
        return City::where('name', 'LIKE', $term . '%')->get();               
    } 
    
    //Wyszukanie firm po filtrach
    public function getSearchResults(string $city)
    {
        return City::with(['businesses.photos', 'businesses.address', 'rooms.reservations'])->where('name', $city)->get() ?? false;  
    } 

    //Pobranie danych wybranej sali
    public function getRoomDetails($id)
    {
        return Room::with(['photos', 'reservations'])->find($id);  
    } 


    public function getUser($id)
    {
        return User::with(['comments.commentable', 'businesses', 'photos'])->find($id);  
    }

    
    public function addNotification($id)
    {
        $room = Room::with(['business'])->find($id);

        $notification = new Notification;
        $notification->content = 'Dokonano rezerwacji w '. $room->business->name;
        $notification->notification_type = 'App\Models\Business';
        $notification->status = false;
        $notification->notification_id = $room->business->id;

        return $notification->save();
    }

}
