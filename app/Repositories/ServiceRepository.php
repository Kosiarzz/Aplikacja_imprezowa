<?php

namespace App\Repositories;
use App\Models\Business;
use App\Models\Service;
use App\Models\Photo;
use App\Models\Notification;
use App\Models\Statistic;
use App\Models\Reservation;
use App\Models\City;
use App\Models\Address;
use App\Models\Social;
use App\Models\QuestionAndAnswer;
use App\Models\Contact;
use App\Models\OpeningHours;
use App\Models\GroupBusiness;
use App\Models\StatisticService;
use App\Models\GroupCategory;
use App\Models\Category;
use App\Models\StatisticsCategory;

use App\Interfaces\ServiceRepositoryInterface;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function getNotifications()
    { 
        return Notification::where('notification_type', 'App\Models\Business')->where('notification_id', session('service'))->orderBy('created_at','desc')->paginate(10);
    }

    public function getBusinessDetails($id)
    {
        return Business::with(['city','owner','photos','openingHours','comments.user.photos','comments.user.contactable','questionsAndAnswers','address','users.photos','services.photos','contactable','categories.category', 'groupBusiness.groupCategory.category'])->find($id);
    }

    public function getRate($business)
    {
        $rate = 0;

        foreach($business->comments as $comment)
        {
            $rate += $comment->rating['value'];
        }

        if(count($business->comments) != 0)
        {
            $rate = $rate/count($business->comments);
        }

        return $rate;
    }

    public function getDashboard()
    {
        return Business::with(['city','photos','owner','openingHours','comments.user.photos', 'comments.user.contactable','questionsAndAnswers','address','users.photos','services.photos','contactable','categories.category' ,'groupBusiness.groupCategory.category'])->find(session('service'));
    }

    public function getBusinessReservations()
    {
        return Business::with([

                  'services' => function($q) { //zwracanie sali która ma przynajmniej jedną rezerwacje
                        $q->has('reservations');
                    }, 

                    'services.reservations.event.user.contactable',

                  ])
                    ->has('services.reservations') 
                    ->where('id', session('service'))
                    ->get();
    }

    public function getBusinessServices()
    {
        return Business::with(['services.photos'])->find(session('service'));
    }
    
    public function getMainCategory()
    {
        return Business::with(['mainCategory'])->find(session('service'));
    }

    public function businessEditSave($request)
    {
       
        $city = City::firstOrCreate([
            "name" => $request->city,
        ]);

        
        Business::where('id', session('service'))->update([
            'name' => $request->businessName,
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->shortDescription,
            'city_id' => $city->id,
            'main_category_id' => $request->mainCategory,
            'name_category' => $request->type,
            'beds' => $request->beds,
        ]);

        Photo::where('photoable_id', session('service'))->where('photoable_type', 'App\Models\Business')->delete();

        if($request->image != null)
        {
            foreach($request->image as $image)
            {
                $photo = new Photo();
                $photo->path = $image->store('photos');
                $photo->photoable_type = 'App\Models\Business';
                $photo->photoable_id = session('service');
                $photo->save();
            }
        }

        if($request->currentImage != null)
        {
            foreach($request->currentImage as $image)
            {
                $photo = new Photo();
                $photo->path = $image;
                $photo->photoable_type = 'App\Models\Business';
                $photo->photoable_id = session('service');
                $photo->save();
            }
        }

        Social::where('business_id', session('service'))->update([
            'facebook' => $request->facebook,
            'www' => $request->www,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'movie_youtube' => $city->youtubeMovie,
        ]);

        Address::where('business_id', session('service'))->update([
            'street' => $request->street,
            'post_code' => $request->postCode,
        ]);

        Contact::where('contactable_id', session('service'))->where('contactable_type', 'App\Models\Business')->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
        ]);

        GroupBusiness::where('business_id', session('service'))->delete();
        GroupCategory::where('group_id', $request->groupPartyId)->where('type', 'business')->delete();
        GroupCategory::where('group_id', $request->groupAdditionalId)->where('type', 'business')->delete();

        if($request->party != null)
        {
            $groupBusiness = new GroupBusiness;
            $groupBusiness->name = 'party';
            $groupBusiness->type = 'party';
            $groupBusiness->business_id = session('service');
            $groupBusiness->save();
            foreach($request->party as $categoryId)
            {
                $groupCategory = new GroupCategory;
                $groupCategory->type = 'business';
                $groupCategory->group_id = $groupBusiness->id;
                $groupCategory->category_id = $categoryId;
                $groupCategory->save();
            }
        }

        if($request->additional != null)
        {
            $groupBusiness = new GroupBusiness;
            $groupBusiness->name = 'additional';
            $groupBusiness->type = 'additional';
            $groupBusiness->business_id = session('service');
            $groupBusiness->save();

            foreach($request->additional as $categoryId)
            {
                $groupCategory = new GroupCategory;
                $groupCategory->type = 'business';
                $groupCategory->group_id = $groupBusiness->id;
                $groupCategory->category_id = $categoryId;
                $groupCategory->save();
            }
        }

        $groupBusiness = new GroupBusiness;
        $groupBusiness->name = 'user';
        $groupBusiness->type = 'user';
        $groupBusiness->business_id = session('service');
        $groupBusiness->save();

        if($request->user != null){
            foreach($request->user as $categoryName)
            {
                $category = Category::firstOrCreate([
                    "name" => $categoryName,
                ]);

                StatisticsCategory::firstOrCreate([
                    "category_id" => $category->id,
                    "type" => $request->type,
                ])->increment('stats', 1);

                $groupCategory = new GroupCategory;
                $groupCategory->type = 'business';
                $groupCategory->group_id = $groupBusiness->id;
                $groupCategory->category_id = $category->id;
                $groupCategory->save();
            }
        }

        if($request->popular != null)
        {
            foreach($request->popular as $categoryId)
            {
                $groupCategory = new GroupCategory;
                $groupCategory->type = 'business';
                $groupCategory->group_id = $groupBusiness->id;
                $groupCategory->category_id = $categoryId;
                $groupCategory->save();

                StatisticsCategory::firstOrCreate([
                    "category_id" => $categoryId,
                    "type" => $request->type,
                ])->increment('stats', 1);

            }
        }

        QuestionAndAnswer::where('business_id', session('service'))->delete();
        if($request->question != null && $request->answer != null )
        {
            $i=0;
            foreach($request->question as $question)
            {   
                $QuestionAndAnswer = new QuestionAndAnswer;
                $QuestionAndAnswer->question = $request->question[$i];
                $QuestionAndAnswer->answer = $request->answer[$i];
                $QuestionAndAnswer->business_id = session('service');
                $QuestionAndAnswer->save();
                $i++;
            }
        }

        $openingHours = new OpeningHours;

        if($request->closeMonday == "on")
        {
            $openingHours->monday = "Zamknięte";
        }
        else
        {
            $openingHours->monday = $request->monday;
        }

        if($request->closeTuesday == "on")
        {
            $openingHours->tuesday = "Zamknięte";
        }
        else
        {
            $openingHours->tuesday = $request->tuesday;
        }

        if($request->closeWednesday == "on")
        {
            $openingHours->wednesday = "Zamknięte";
        }
        else
        {
            $openingHours->wednesday = $request->wednesday;
        }

        if($request->closeThursday == "on")
        {
            $openingHours->thursday = "Zamknięte";
        }
        else
        {
            $openingHours->thursday = $request->thursday;
        }

        if($request->closeFriday == "on")
        {
            $openingHours->friday = "Zamknięte";
        }
        else
        {
            $openingHours->friday = $request->friday;
        }

        if($request->closeSaturday == "on")
        {
            $openingHours->saturday = "Zamknięte";
        }
        else
        {
            $openingHours->saturday = $request->saturday;
        }

        if($request->closeSunday == "on")
        {
            $openingHours->sunday = "Zamknięte";
        }
        else
        {
            $openingHours->sunday = $request->sunday;
        }

        $openingHours->business_id = session('service');
        $openingHours->save();

        
    }
    
    public function addService($request)
    {
        $service = new Service();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->people_from = $request->minPeople;
        $service->people_to = $request->maxPeople;
        $service->price_from = $request->priceFrom;
        $service->price_to = $request->priceTo;
        $service->unit = $request->unit;
        $service->size = $request->size;
        $service->business_id = session('service');
        $service->save();
        
        if($request->image != null)
        {
            foreach($request->image as $image)
            {
                $photo = new Photo();
                $photo->path = $image->store('photos');
                $photo->photoable_type = 'App\Models\Service';
                $photo->photoable_id = $service->id;
                $photo->save();
            }
        }

        return $service;
    }

    public function editService($request)
    {

        Service::where('id', $request->idService)->update([
            'title' => $request->title,
            'description' => $request->description,
            'people_from' => $request->minPeople,
            'people_to' => $request->maxPeople,
            'price_from' => $request->priceFrom,
            'price_to' => $request->priceTo,
            'unit' => $request->unit,
            'size' => $request->size,
        ]);
        
        Photo::where('photoable_id', $request->idService)->delete();

        if($request->currentImage != null)
        {
            foreach($request->currentImage as $image)
            {
                $photo = new Photo();
                $photo->path = $image;
                $photo->photoable_type = 'App\Models\Service';
                $photo->photoable_id = $request->idService;
                $photo->save();
            }
        }

        if($request->image != null)
        {
            foreach($request->image as $image)
            {
                $photo = new Photo();
                $photo->path = $image->store('photos');
                $photo->photoable_type = 'App\Models\Service';
                $photo->photoable_id = $request->idService;
                $photo->save();
            }
        }

        return Service::with(['photos', 'business', 'reservations'])->find($request->idService);
    }

    public function getPartyCategory()
    {
        return GroupBusiness::with(['groupCategory' => function($q){ 
            $q->where('type', 'business')->with('category');
            } 
        ])->where('business_id', session('service'))->where('name', 'party')->get();
    }

    public function getAdditionalCategory()
    {
        return GroupBusiness::with(['groupCategory' => function($q){ 
            $q->where('type', 'business')->with('category');
            } 
        ])->where('business_id', session('service'))->where('name', 'additional')->get();
    }

    public function getUserCategory()
    {
        return GroupBusiness::with(['groupCategory' => function($q){ 
            $q->where('type', 'business')->with('category');
            } 
        ])->where('business_id', session('service'))->where('name', 'user')->get();
    }

    public function editBusiness($id)
    {
        return Business::with(['city', 'mainCategory', 'social', 'openingHours', 'photos','comments.user.photos','comments.user.contactable','questionsAndAnswers','address','users.photos','services.photos','contactable'])->find($id);
    }

    public function getBusinessCategory()
    {
        return GroupBusiness::with(['groupCategory' => function($q){ 
            $q->where('type', 'business')->with('category');
            } 
        ])->where('business_id', session('service'))->get();
    }

    public function deleteService($id)
    {
        return Service::where('id', $id)->delete();  
    }

    public function deleteBusiness($id)
    {
        return Business::where('id', $id)->delete();  
    }
    
    public function getServices()
    {
        return Service::where('business_id', session('service'))->get();  
    }

    public function getServiceDetails($id)
    {
        return Service::with(['photos', 'business', 'reservations'])->find($id);  
    }

    public function getEditServiceDetails($id)
    {
        return Business::with([
            'services' => function($q) use($id){ //zwracanie sali która ma przynajmniej jedną rezerwacje
                $q->where('id', $id);
            },'services.photos',
        ])->find(session('service'));  
    }

    public function getDetailsReservations($id)
    {
        return Reservation::with(['service', 'event.user.contactable'])->where('service_id', $id)->where('status', 'Oczekiwanie na akceptację')->paginate(10);
    }

    public function getDetailsReservationsFilters($request)
    {
        $reservations = Reservation::with(['service'])
            ->whereHas('event.user.contactable', function ($query) use($request){
                if(!is_null($request->name)){
                    $query->where('name', '=', $request->name);
                }
                if(!is_null($request->surname)){
                    $query->where('surname', '=', $request->surname);
                }
                if(!is_null($request->phone)){
                    $query->where('phone', '=', $request->phone);
                }  
        })->where('service_id', $request->serviceId);

        if(!is_null($request->date_from)){
            $reservations->where('date_from', '>=', $request->date_from);
        }

        if(!is_null($request->date_to)){
            $reservations->where('date_to', '<=', $request->date_to);
        }

        if(!is_null($request->status))
        {
            $reservations->where('status', $request->status);
        }
                                    
        return $reservations->paginate(10);
    }
    
    public function setReadNotifications($notifications)
    {
        if($notifications != null){
            foreach($notifications as $notification)
            {
                if($notification->status != 1){
                    Notification::where('id', $notification->id)->update(['status' => 1]);
                }
            }
        }
    }

    public function getToDayStats()
    {
        return Statistic::firstOrCreate([
            "date" => Carbon::now()->format('Y-m-d'),
            "business_id" => session('service'),
        ]);

    }

    public function getStatsBusiness($request)
    {
        return Statistic::whereBetween('date', [$request->date_from , $request->date_to])->where('business_id', session('service'))->get();
    }

    public function getStatsService($request)
    {

        return Service::with('statistic')->whereHas('statistic', function ($query) use($request){
            $query->whereBetween('date', [$request->date_from , $request->date_to]);
        })->where('id', $request->service)->get();
      
    }

    public function getToDayStatsOffers()
    {
        return Service::with(['statistic' => function ($query){
                $query->where('date', Carbon::now()->format('Y-m-d'));
            }])->where('business_id', session('service'))->get();

    }

    public function getToLastSevenDaysStatsOffers()
    {
        $toDate = Carbon::now();
        $toDate->subDay(1);
   
        $fromDate = Carbon::createFromFormat('Y-m-d', $toDate->toDateString()); 
        $fromDate->subDay(7);

        return Service::with(['statistic' => function ($query) use($fromDate, $toDate){
                    $query->whereBetween('date', [$fromDate , $toDate]);
                }])->where('business_id', session('service'))->get();
    }
  
}
