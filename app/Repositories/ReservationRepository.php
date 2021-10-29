<?php

namespace App\Repositories;
use App\Models\Reservation;

class ReservationRepository
{
   
    public function addReservation($service_id, $city_id, $request)
    {
        return Reservation::create([
                'event_id'=>session('event'),
                'city_id'=>$city_id,
                'service_id'=>$service_id,
                'status'=>0,
                'date_from'=>date('Y-m-d', strtotime($request->input('dateFrom'))),
                'date_to'=>date('Y-m-d', strtotime($request->input('dateTo')))
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

    public function deleteReservation(Reservation $reservation)
    {
        return $reservation->delete();
    }

    public function confirmReservation(Reservation $reservation)
    {
        return $reservation->update(['status' => true]);
    }

}
