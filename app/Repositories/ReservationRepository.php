<?php

namespace App\Repositories;
use App\Models\Reservation;

class ReservationRepository
{
   
    public function addReservation($room_id, $city_id, $request)
    {
        return Reservation::create([
                'user_id'=>$request->user()->id,
                'city_id'=>$city_id,
                'room_id'=>$room_id,
                'status'=>0,
                'date_from'=>date('Y-m-d', strtotime($request->input('dateFrom'))),
                'date_to'=>date('Y-m-d', strtotime($request->input('dateTo')))
            ]);
    }

    public function getReservationsByRoomId($id)
    {
        return Reservation::where('room_id', $id)->get(); 
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

    public function getReservations($id)
    {
        return Reservation::where('user_id', $id)->get();
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
