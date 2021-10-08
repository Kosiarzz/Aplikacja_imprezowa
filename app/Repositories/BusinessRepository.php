<?php

namespace App\Repositories;

use App\Models\Business;
use App\Models\Reservation;
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
        return Business::with(['city','photos','comments.user','comments.photos','questionsAndAnswers','address','users.photos','rooms.photos'])->find($id);
    }

    public function getBusinessReservations($request)
    {
        return Business::with([

                  'rooms' => function($q) { //zwracanie sali która ma przynajmniej jedną rezerwacje
                        $q->has('reservations');
                    }, 

                    'rooms.reservations.user'

                  ])
                    ->has('rooms.reservations') 
                    ->where('user_id', $request->user()->id)
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
}
