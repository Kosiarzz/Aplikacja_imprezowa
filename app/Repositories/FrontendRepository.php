<?php

namespace App\Repositories;

use App\Models\Business;
use App\Models\City;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Group;
use App\Models\Statistic;
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

    public function getCategoryMainPage()
    {
        return Group::with(['groupCategory.category'])->where('type','mainCategory')->where('name','mainCategory')->get();
    }

    //Pobranie danych wybranej firmy
    public function getBusinessDetails($id)
    {
        Statistic::firstOrCreate([
            "business_id" => $id,
        ])->increment('views', 1);

        return Business::with(['city','photos','comments.user.photos','questionsAndAnswers','address','users.photos','services.photos'])->find($id);
    }

    //Wyszukanie miasta po pierwszych kilku literach
    public function getSearchCities(string $term)
    {
        return City::where('name', 'LIKE', $term . '%')->get();               
    } 
    
    //Wyszukanie firm po filtrach
    public function getSearchResults($request)
    {
        $business = Business::with(['photos', 'address', 'services.reservations', 'categories', 'mainCategory', 'city']);

        //Nazwa miasta
        if(!is_null($request->city))
        {
            $business->whereHas('city', function($query) use ($request) {
                $query->where('name', $request->city);
            });
        } 

        //Głowna kategoria usługi
        if($request->mainCategory != 0)
        {
            $business->where('main_category_id', $request->mainCategory);
        }      

        return $business->get();
    } 

    //Pobranie danych wybranej sali
    public function getServiceDetails($id)
    {
        return Service::with(['photos', 'reservations'])->find($id);  
    } 


    public function getUser($id)
    {
        return User::with(['comments.commentable', 'businesses', 'photos'])->find($id);  
    }

    
    public function addNotification($id)
    {
        $service = Service::with(['business'])->find($id);

        $notification = new Notification;
        $notification->content = 'Dokonano rezerwacji w '. $service->business->name;
        $notification->notification_type = 'App\Models\Business';
        $notification->status = false;
        $notification->notification_id = $service->business->id;

        return $notification->save();
    }

}
