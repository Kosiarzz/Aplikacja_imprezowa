<?php

namespace App\Repositories;
use App\Models\Business;
use App\Models\Service;
use App\Models\Photo;
use App\Models\Notification;
use App\Models\Statistic;

use App\Interfaces\ServiceRepositoryInterface;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function getNotifications()
    { 
        return Business::with(['notification'])->find(session('service'));
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
    
    public function setReadNotifications($notifications)
    {
        foreach($notifications->notification as $notification)
        {
            Notification::where('id', $notification->id)->update(['status' => 1]);
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
