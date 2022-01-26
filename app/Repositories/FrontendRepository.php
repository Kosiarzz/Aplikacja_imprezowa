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
use App\Models\GroupBusiness;
use App\Interfaces\FrontendRepositoryInterface;

use Illuminate\Support\Carbon;
//use App\Models\{Business,City};
class FrontendRepository implements FrontendRepositoryInterface
{
    //Komunikacja z bazą danych

    //Pobranie danych na stronę główną
    public function getDataMainPage()
    {
        return  Business::with(['photos', 'address', 'services.reservations', 'categories.category', 'mainCategory', 'city', 'services', 'comments', 
                'GroupBusiness' => function($q) {
                    $q->where('type', 'party')->with(['groupCategory' => function($query){
                        $query->where('type', 'business')->with(['category']);
                    }]);
                }])->paginate(20);
    }

    public function getCategoryMainPage()
    {
        return Group::with(['groupCategory.category'])->where('type','mainCategory')->where('name','mainCategory')->get();
    }

    //Pobranie danych wybranej firmy
    public function getBusinessDetails($id)
    {
        $date = Carbon::now();

        Statistic::firstOrCreate([
            "business_id" => $id,
            "date" => $date->toDateString(),
            "type" => 'business',
        ])->increment('views', 1);

        return Business::with(['city','photos','comments.user.photos','questionsAndAnswers','address','users.photos','services.photos','openingHours'])->find($id);
    }

    //Wyszukanie miasta po pierwszych kilku literach
    public function getSearchCities(string $term)
    {
        return City::where('name', 'LIKE', $term . '%')->get();               
    } 
    
    //Wyszukanie firm po filtrach
    public function getSearchResults($request)
    {
        $business = Business::with(['photos','services', 'address', 'categories.category', 'mainCategory', 'city', 'services', 'comments', 
        'GroupBusiness' => function($q) {
            $q->where('type', 'party')->with(['groupCategory' => function($query){
                $query->where('type', 'business')->with(['category']);
            }]);
        }]);

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

        $business->whereBetween('rating', [$request->rateFrom, $request->rateTo]);

        return $business->paginate(20);
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

    public function getPartyCategory($id)
    {
        return GroupBusiness::with(['groupCategory' => function($q){ 
            $q->where('type', 'business')->with('category');
            } 
        ])->where('business_id', $id)->where('name', 'party')->get();
    }

    public function getAdditionalCategory($id)
    {
        return GroupBusiness::with(['groupCategory' => function($q){ 
            $q->where('type', 'business')->with('category');
            } 
        ])->where('business_id', $id)->where('name', 'additional')->get();
    }

    
    public function getUserCategory($id)
    {
        return GroupBusiness::with(['groupCategory' => function($q){ 
            $q->where('type', 'business')->with('category');
            } 
        ])->where('business_id', $id)->where('name', 'user')->get();
    }

}
