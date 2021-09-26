<?php

namespace App\Repositories;

use App\Models\Business;
use App\Models\City;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Comment;
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

    public function getReservationsByRoomId($id)
    {
        return Reservation::where('room_id', $id)->get(); 
    }

    public function getUser($id)
    {
        return User::with(['comments.commentable', 'businesses', 'photos'])->find($id);  
    }

    public function like($likeable_id, $type, $request)
    {
        $likeable = $type::find($likeable_id);
      
        return $likeable->users()->attach($request->user()->id);
    }
    
    public function unlike($likeable_id, $type, $request)
    {
        $likeable = $type::find($likeable_id);
      
        return $likeable->users()->detach($request->user()->id);
    }

    public function addComment($commentable_id, $type, $request)
    {
        $commentable = $type::find($commentable_id);
        
        $comment = new Comment;
        
        $comment->content = $request->input('content');
        $comment->rating = $request->input('rating');
        $comment->user_id = $request->user()->id;
        
        return $commentable->comments()->save($comment);
    }

    
    public function addReservation($room_id, $city_id, $request)
    {
        return Reservation::create([
                'user_id'=>$request->user()->id,
                'city_id'=>$city_id,
                'room_id'=>$room_id,
                'status'=>0,
                'date_from'=>date('Y-m-d', strtotime($request->input('dateFrom'))),
                'date_to'=>date('Y-m-d', strtotime($request->input('dateTo')))
            ]);
    }
 
}
