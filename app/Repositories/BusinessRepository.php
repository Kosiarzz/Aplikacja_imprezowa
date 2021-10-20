<?php

namespace App\Repositories;

use App\Models\Business;
use App\Models\Reservation;
use App\Models\Category;
use App\Models\Social;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Room; 
use App\Models\Photo; 
use App\Models\City; 
use App\Models\BusinessCategory; 
use App\Models\Notification;
use App\Models\QuestionAndAnswer;
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
        session(['business' => $id]);
        return Business::with(['city','photos','comments.user','questionsAndAnswers','address','users.photos','rooms.photos','contactable','categories.category'])->find($id);
    }

    public function getBusinessReservations($request)
    {
        return Business::with([

                  'rooms' => function($q) { //zwracanie sali która ma przynajmniej jedną rezerwacje
                        $q->has('reservations');
                    }, 

                    'rooms.reservations.user.contactable',

                  ])
                    ->has('rooms.reservations') 
                    ->where('id', session('business'))
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
        
        $city = City::firstOrCreate([
            "name" => $request->city,
        ]);
        
        $business = new Business;
        $business->name = $request->businessName;
        $business->title = $request->title;
        $business->user_id = Auth::user()->id;
        $business->city_id = $city->id;
        $business->title = $request->title;
        $business->description = $request->description;
        $business->short_description = $request->shortDescription;
        //$business->nip = $request->nip;
        //$business->beds = $request->beds;
        $business->save();
        
        foreach($request->image as $image)
        {
            $photo = new Photo();
            $photo->path = $image->store('photos');
            $photo->photoable_type = 'App\Models\Business';
            $photo->photoable_id = $business->id;
            $photo->save();
        }

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

        foreach($request->dodatkowe as $categoryId)
        {
            $category = new BusinessCategory;
            $category->category_id = $categoryId;
            $business->categories()->save($category);
        }

        foreach($request->atrakcje as $categoryId)
        {
            $category = new BusinessCategory;
            $category->category_id = $categoryId;
            $business->categories()->save($category);
        }

        if($request->user != null){
            foreach($request->user as $categoryName)
            {
                $category = Category::firstOrCreate([
                    "name" => $categoryName,
                    "type" => 'user'
                ]);

                $BusinessCategory = new BusinessCategory;
                $BusinessCategory->category_id = $category->id;
                $business->categories()->save($BusinessCategory);
            }
        }

        foreach($request->popular as $categoryId)
        {
            $BusinessCategory = new BusinessCategory;
            $BusinessCategory->category_id = $categoryId;
            $business->categories()->save($BusinessCategory);
        }

        $category = new BusinessCategory;
        $category->category_id = $request->mainCategory;
        $business->categories()->save($category);

        $i = 0;
        foreach($request->priceFrom as $categoryId)
        {
            $room = new Room;
            $room->title = $request->titleRoom[$i];
            $room->description = $request->descriptionRoom[$i];
            $room->price_from = $request->priceFrom[$i];
            $room->price_to = $request->priceTo[$i];
            $room->people_from = $request->minPeople[$i];
            $room->people_to = $request->maxPeople[$i];
            $room->size = $request->sizeRoom[$i];
            $room->unit = $request->unit[$i];
            $business->rooms()->save($room);
            
            foreach($request->imageRoom as $image)
            {
                $photo = new Photo();
                $photo->path = $image->store('photos');
                $photo->photoable_type = 'App\Models\Room';
                $photo->photoable_id = $room->id;
                $photo->save();
            }

            $i++;
        }

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->surname = $request->surname;
        $contact->phone = $request->phone;
        $business->contactable()->save($contact);

        $i=0;

        foreach($request->question as $question)
        {   
            $QuestionAndAnswer = new QuestionAndAnswer;
            $QuestionAndAnswer->question = $request->question[$i];
            $QuestionAndAnswer->answer = $request->answer[$i];
            $business->questionsAndAnswers()->save($QuestionAndAnswer);

            $i++;
        }

        
    }



    public function getBusinessNotifications($id)
    {
        return Notification::with(['notification'])
                ->where('notification_id', $id)
                ->where('notification_type','App\Models\Business')->get();
    }

    public function addNotification($reservation, $text)
    {   
        $notification = new Notification;
        $notification->content = $text;
        $notification->notification_type = 'App\Models\User';
        $notification->status = false;
        $notification->notification_id = $reservation->user_id;

        return $notification->save();
    }
}
