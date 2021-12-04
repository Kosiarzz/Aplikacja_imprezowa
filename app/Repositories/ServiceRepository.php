<?php

namespace App\Repositories;
use App\Models\Business;
use App\Models\Service;
use App\Models\Photo;
use App\Models\Notification;
use App\Models\Statistic;
use App\Models\Reservation;

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
        return Business::with(['city','photos','comments.user','questionsAndAnswers','address','users.photos','services.photos','contactable','categories.category'])->find($id);
    }

    public function getDashboard()
    {
        return Business::with(['city','photos','comments.user','questionsAndAnswers','address','users.photos','services.photos','contactable','categories.category'])->find(session('service'));
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
        
        foreach($request->image as $image)
        {
            $photo = new Photo();
            $photo->path = $image->store('photos');
            $photo->photoable_type = 'App\Models\Service';
            $photo->photoable_id = $service->id;
            $photo->save();
        }

        return $service;
    }

    public function deleteService($id)
    {
        return Service::where('id', $id)->delete();  
    }
    
    public function getServices()
    {
        return Service::where('business_id', session('service'))->get();  
    }

    public function getServiceDetails($id)
    {
        return Service::with(['photos', 'reservations'])->find($id);  
    }

    public function getEditServiceDetails($id)
    {
        return Business::with([
            'services' => function($q) use($id){ //zwracanie sali która ma przynajmniej jedną rezerwacje
            $q->where('id', $id);
            },
        ])->find(session('service'));  
    }

    public function getDetailsReservations($id)
    {
        return Reservation::with(['service', 'event.user.contactable'])->where('service_id', $id)->where('status', 'Oczekiwanie na akceptację')->get();
    }

    public function getDetailsReservationsFilters($request)
    {
        $reservations = Reservation::with(['service', 'event.user.contactable'])->where('service_id', $request->serviceId);
                                
        if(!is_null($request->date_from) && !is_null($request->date_to))
        {
            $reservations->whereBetween('date_from', [$request->date_from, $request->date_to])
                        ->orWhere(function($query) use($request) {
                            $query->whereBetween('date_to', [$request->date_from, $request->date_to])->where('service_id', $request->serviceId);
                        });
        }

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
                                    
        return $reservations->get();
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
  
}
