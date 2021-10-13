<?php

namespace App\Repositories;

use App\Models\Business;
use App\Models\Reservation;
use App\Models\Category;
use App\Models\Social;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Room; 
use App\Models\BusinessCategory;
use App\Interfaces\BusinessRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BusinessRepository implements BusinessRepositoryInterface
{
    public function getAllBusiness()
    {
        return Business::where('user_id', Auth::user()->id)->get();
    }

    //Pobranie danych wybranej firmy
    public function getBusinessDetails($id)
    {
        return Business::with(['city','photos','comments.user','comments.photos','questionsAndAnswers','address','users.photos','rooms.photos','contact','categories.category'])->find($id);
    }

    public function getBusinessReservations($request)
    {
        return Business::with([

                  'rooms' => function($q) { //zwracanie sali która ma przynajmniej jedną rezerwacje
                        $q->has('reservations');
                    }, 

                    'rooms.reservations.user'

                  ])
                    ->has('rooms.reservations') 
                    ->where('user_id', $request->user()->id)
                    ->get();
    }

    public function getReservationData($request)
    {
        return Reservation::with('user', 'room')
                ->where('room_id', $request->input('room_id'))
                ->where('day_in', '<=', date('Y-m-d', strtotime($request->input('date'))))
                ->where('day_out', '>=', date('Y-m-d', strtotime($request->input('date'))))
                ->first();
    }

    public function getCategory()
    {
        return Category::all();
    }

    public function addBusiness($request)
    {
        
        $business = new Business;
        $business->name = $request->businessName;
        $business->title = $request->title;
        $business->user_id = Auth::user()->id;
        $business->city_id = rand(1,10);
        $business->title = $request->title;
        $business->description = $request->description;
        $business->short_description = $request->shortDescription;
        $business->nip = $request->nip;
        $business->save();

        $social = new Social;
        $social->facebook = $request->facebook;
        $social->www = $request->www;
        $social->instagram = $request->instagram;
        $social->youtube = $request->youtube;
        $social->movie_youtube = $request->youtubeMovie;
        $business->social()->save($social);

        $address = new Address;
        $address->street = $request->street;
        $address->post_code = $request->postCode;
        $business->address()->save($address);


        foreach($request->party as $categoryId)
        {
            $category = new BusinessCategory;
            $category->category_id = $categoryId;
            $business->categories()->save($category);
            
        }

        $room = new Room;
        $room->title = $request->titleRoom;
        $room->description = $request->descriptionRoom;
        $room->price_from = $request->priceFrom;
        $room->price_to = $request->priceTo;
        $room->people_from = $request->minPeople;
        $room->people_to = $request->maxPeople;
        $room->size = $request->sizeRoom;
        $room->unit = $request->unit;

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->surname = $request->surname;
        $contact->phone = $request->phone;

        $business->contact()->save($contact);
    }

    /**
     *"_token" => "aAfnQAlc2eaZJS9q8fx67yZClVZZ2EhLuoMMemvg"
     * #"title" => null
     * #"shortDescription" => null
     * #"description" => null
     * "mainCategory" => "---------"
     * "party" => array:4 [▶]
     * "beds" => null
     * #"priceFrom" => null
     * #"priceTo" => null
     * #"unit" => null
      *#"titleRoom" => null
      *#"descriptionRoom" => null
      *#"minPeople" => null
     * #"maxPeople" => null
      *#"sizeRoom" => null
      *"imageRoom" => null
      *#"name" => null
      *#"surname" => null
      *#"businessName" => null
      *"nip" => null
      *#"phone" => null
      *#"www" => null
      *#"facebook" => null
      *#"instagram" => null
      *#"youtube" => null
      *"city" => null
      *#"street" => null
      *#"postCode" => null
      *"image" => null
      *#"youtubeMovie" => null
      *"avatar" => null
      *"timeOpen" => null
     */
}
