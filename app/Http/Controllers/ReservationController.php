<?php

namespace App\Http\Controllers;

use App\Repositories\ReservationRepository;
use App\Repositories\NotificationRepository;
use App\Models\Reservation;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct(ReservationRepository $rRepository, NotificationRepository $nRepository)
    {
        $this->middleware('auth')->only(['addReservation', 'confirmReservation', 'deleteReservation']);

        $this->rRepository = $rRepository;
        $this->nRepository = $nRepository;
    }

    public function addReservation($room_id, $city_id, Request $request)
    {
        $this->rRepository->addReservation($room_id, $city_id, $request);
        #$this->nRepository->addNotification($request, 'Dodano rezerwacje');

        return redirect()->back();
    }

    public function ajaxGetRoomReservations($id)
    {
        $reservations = $this->rRepository->getReservationsByRoomId($id);

        return response()->json([
            'reservations' => $reservations
        ]);
    }

    public function confirmReservation($id)
    {
        $reservation = $this->rRepository->getReservation($id);

        $this->authorize('reservation', $reservation);

        $this->rRepository->confirmReservation($reservation);
        //$this->rRepository->addNotification($reservation, 'Rezerwacja zaakceptowana');

        return redirect()->back();
    }
    
    public function deleteReservation($id)
    {
        $reservation = $this->rRepository->getReservation($id);

        $this->authorize('reservation', $reservation);
        
        $this->rRepository->deleteReservation($reservation);
        //$this->rRepository->addNotification($reservation, 'Rezerwacja odrzucona');

        return redirect()->back();
    }

}
