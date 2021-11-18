<?php

namespace App\Repositories;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Business;
use App\Models\Reservation;
use App\Models\Category;
use App\Models\Social;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Service; 
use App\Models\Photo; 
use App\Models\City; 
use App\Models\Group; 
use App\Models\BusinessCategory; 
use App\Models\Notification;
use App\Models\QuestionAndAnswer;
use App\Models\StatisticsCategory;
use App\Interfaces\BusinessRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BusinessRepository implements BusinessRepositoryInterface
{
    public function getAllBusiness()
    {
        return Business::with(['notification'])->where('user_id', Auth::user()->id)->get();
    }

    //Pobranie danych wybranej firmy
    public function getBusinessDetails($id)
    {
        session(['business' => $id]);
        return Business::with(['city','photos','comments.user','questionsAndAnswers','address','users.photos','services.photos','contactable','categories.category'])->find($id);
    }

    public function getProfile()
    {
        $profile = User::with(['contactable', 'photos'])->find(Auth::user()->id);

        if($profile->role != (UserRole::USER) && $profile->role != (UserRole::BUSINESS))
        {
            return false;
        }

        return $profile;
    }

    public function getBusinessReservations($request)
    {
        return Business::with([

                  'services' => function($q) { //zwracanie sali która ma przynajmniej jedną rezerwacje
                        $q->has('reservations');
                    }, 

                    'services.reservations.user.contactable',

                  ])
                    ->has('services.reservations') 
                    ->where('id', session('business'))
                    ->get();
    }

    public function getReservationData($request)
    {
        return Reservation::with('user', 'service')
                ->where('service_id', $request->input('service_id'))
                ->where('day_in', '<=', date('Y-m-d', strtotime($request->input('date'))))
                ->where('day_out', '>=', date('Y-m-d', strtotime($request->input('date'))))
                ->first();
    }

    public function getCategory($type)
    {
        return Group::with(['groupCategory.category'])->where('type', $type.'Category')->where('name', $type.'Category')->get();
    }
    
    public function getAdditionalCategory($type)
    {
        return Group::with(['groupCategory.category'])->where('type', $type.'SelectCategory')->where('name', $type.'SelectCategory')->get();
    }

    public function getPartyCategory()
    {
        return Group::with(['groupCategory.category'])->where('type', 'partyCategory')->where('name', 'partyCategory')->get();
    }
    
    public function getStatsCategory($type)
    {
        return StatisticsCategory::with(['category'])->where('type', $type)->where('stats', '>' , -1)->orderBy('stats','desc')->take(50)->get();
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
        $business->main_category_id = $request->mainCategory;
        $business->name_category = $request->type;
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

        foreach($request->additional as $categoryId)
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
                ]);

                $statisticCategory = StatisticsCategory::firstOrCreate([
                    "category_id" => $category->id,
                    "type" => $request->type,
                ])->increment('stats', 1);

                $BusinessCategory = new BusinessCategory;
                $BusinessCategory->category_id = $category->id;
                $business->categories()->save($BusinessCategory);
            }
        }

        if($request->popular != null)
        {
            foreach($request->popular as $categoryId)
            {
                $BusinessCategory = new BusinessCategory;
                $BusinessCategory->category_id = $categoryId;

                $statisticCategory = StatisticsCategory::firstOrCreate([
                    "category_id" => $categoryId,
                    "type" => $request->type,
                ])->increment('stats', 1);

                $business->categories()->save($BusinessCategory);
            }
        }

        $category = new BusinessCategory;
        $category->category_id = $request->mainCategory;
        $business->categories()->save($category);

        $i = 0;
        foreach($request->priceFrom as $categoryId)
        {
            $service = new Service;
            $service->title = $request->titleService[$i];
            $service->description = $request->descriptionService[$i];
            $service->price_from = $request->priceFrom[$i];
            $service->price_to = $request->priceTo[$i];
            $service->people_from = $request->minPeople[$i];
            $service->people_to = $request->maxPeople[$i];
            $service->size = $request->sizeService[$i];
            $service->unit = $request->unit[$i];
            $business->services()->save($service);
            
            foreach($request->imageService as $image)
            {
                $photo = new Photo();
                $photo->path = $image->store('photos');
                $photo->photoable_type = 'App\Models\Service';
                $photo->photoable_id = $service->id;
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

    public function getServiceBusiness($id)
    {
        return Service::with(['business'])->find($id);
    }
    
}
