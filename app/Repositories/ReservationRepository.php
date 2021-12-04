<?php

namespace App\Repositories;
use App\Models\Reservation;
use App\Models\Statistic;
use App\Models\Service;
use App\Models\Category;

use Illuminate\Support\Carbon;

class ReservationRepository
{
   
    public function addReservation($service_id, $service_name, $city_id, $request)
    {
        $service = Service::with(['business'])->find($service_id);
        $category = Category::where('id', $service->business->main_category_id)->get();

        Statistic::firstOrCreate([
            "date" => Carbon::now()->format('Y-m-d'),
            "business_id" => $service->business->id,
        ])->increment('reservations', 1);
            
        return Reservation::create([
                'event_id'=>session('event'),
                'city_id'=>$city_id,
                'service_id'=>$service_id,
                'status'=> 'Oczekiwanie na akceptację',
                'name_user' => $category[0]->name.' ('.$service->title.')',
                'name_business' => 'Oferta '.$service_name,
                'date_from' => date('Y-m-d', strtotime($request->input('dateFrom'))),
                'date_to' => date('Y-m-d', strtotime($request->input('dateTo')))
            ]);
    }

    public function getReservationsByServiceId($id)
    {
        return Reservation::where('service_id', $id)->get(); 
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

    public function getReservations($id)
    {
        return Reservation::with(['service.business.photos', 'service.business.contactable', 'service.business.address'])->where('event_id', $id)->get();
    }

    public function getReservation($id)
    {
        return Reservation::find($id);
    }

    public function getReservationWithService($id)
    {
        return Reservation::with(['service'])->find($id);
    }

    public function deleteReservation(Reservation $reservation)
    {
        return $reservation->update(['status' => 'Rezerwacja odrzucona']);
    }

    public function cancelReservation(Reservation $reservation)
    {
        return $reservation->update(['status' => 'Rezerwacja anulowana']);
    }

    public function confirmReservation(Reservation $reservation)
    {
        return $reservation->update(['status' => 'Rezerwacja zaakceptowana']);
    }

}
