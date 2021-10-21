<?php

namespace App\Http\Controllers;

use App\Repositories\ReservationRepository;
use App\Repositories\NotificationRepository;
use App\Models\Reservation;
use App\Models\Room;

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
        $business = Room::find($room_id);
        $this->nRepository->addNotificationBusiness($business->business_id, 'Nowa rezerwacja');

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

        $this->nRepository->addNotificationUser($reservation->user_id, 'Rezerwacja została zaakceptowana');

        return redirect()->back();
    }
    
    public function deleteReservation($id)
    {
        $reservation = $this->rRepository->getReservation($id);

        $this->authorize('reservation', $reservation);
        
        $room = Room::find($reservation->room_id);

        $this->rRepository->deleteReservation($reservation);
        $this->nRepository->addNotificationBusiness($room->business_id, 'Rezerwacja została anulowana');
        $this->nRepository->addNotificationUser($reservation->user_id, 'Rezerwacja została anulowana');

        return redirect()->back();
    }

}
