<?php

namespace App\Http\Controllers;

use App\Repositories\ReservationRepository;
use App\Repositories\NotificationRepository;
use App\Models\Reservation;
use App\Models\Service;

use App\Providers\Events\NotificationEvent;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct(ReservationRepository $rRepository, NotificationRepository $nRepository)
    {
        $this->middleware('auth')->only(['addReservation', 'confirmReservation', 'deleteReservation']);

        $this->rRepository = $rRepository;
        $this->nRepository = $nRepository;
    }

    public function addReservation($service_id, $city_id, Request $request)
    {

        $this->rRepository->addReservation($service_id, $city_id, $request);
        $business = Service::find($service_id);
        $this->nRepository->addNotificationBusiness($business->business_id, 'Nowa rezerwacja');

        return redirect()->back();
    }

    public function ajaxGetServiceReservations($id)
    {
        $reservations = $this->rRepository->getReservationsByServiceId($id);

        return response()->json([
            'reservations' => $reservations
        ]);
    }

    public function confirmReservation($id)
    {
        $reservation = $this->rRepository->getReservation($id);

        $this->authorize('reservation', $reservation);

        $this->rRepository->confirmReservation($reservation);
        $this->nRepository->addNotificationEvent($reservation->event_id, 'Rezerwacja została zaakceptowana', 'good');

        return redirect()->back();
    }
    
    public function deleteReservation($id)
    {
        $reservation = $this->rRepository->getReservation($id);

        #$this->authorize('reservation', $reservation);
        
        $service = Service::find($reservation->service_id);

        $this->rRepository->deleteReservation($reservation);
        $this->nRepository->addNotificationEvent($reservation->event_id, 'Rezerwacja została odrzucona', 'danger');

        return redirect()->back();
    }

}
