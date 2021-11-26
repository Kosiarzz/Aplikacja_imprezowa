<?php

namespace App\Http\Controllers;

use App\Repositories\ReservationRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\EventRepository;
use App\Models\Reservation;
use App\Models\Service;

use App\Interfaces\BusinessRepositoryInterface;
use App\Providers\Events\NotificationEvent;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct(ReservationRepository $rRepository, NotificationRepository $nRepository, BusinessRepositoryInterface $bRepository, EventRepository $eRepository,)
    {
        $this->middleware('auth')->only(['addReservation', 'confirmReservation', 'deleteReservation']);

        $this->rRepository = $rRepository;
        $this->nRepository = $nRepository;
        $this->bRepository = $bRepository;
        $this->eRepository = $eRepository;
    }

    public function addReservation($service_id, $city_id, $service_name, Request $request)
    {
        $this->rRepository->addReservation($service_id, $service_name, $city_id,  $request);
        $business = $this->bRepository->getServiceBusiness($service_id);
        
        $this->nRepository->addNotificationBusiness($business->business_id, 'Nowa rezerwacja oferty '.$service_name, 'blueNotification');
        $this->nRepository->addNotificationEvent(session('event'), '['.$business->business->mainCategory->name.'] Wysłano prośbę o rezerwację oferty '.$service_name.'.' , 'blueNotification');

        $this->eRepository->addTaskReservation($service_name, session('event'));
        $this->eRepository->addFinanceReservation($service_name, session('event'));

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
        $reservationService =  $this->rRepository->getReservationWithService($id);

        $this->authorize('reservation', $reservation);

        $this->rRepository->confirmReservation($reservation);

        $service = $this->bRepository->getServiceBusiness($reservationService->service->id);

        $this->nRepository->addNotificationBusiness(session('service'), 'Potwierdziłeś rezerwację oferty '.$reservationService->service->title, 'greenNotification');
        $this->nRepository->addNotificationEvent($reservationService->event_id, '['.$service->business->mainCategory->name.'] Rezerwacja oferty '.$reservationService->service->title.' została zaakceptowana.' , 'greenNotification');


        return redirect()->back();
    }
    
    public function deleteReservation($id)
    {
        $reservation = $this->rRepository->getReservation($id);
        $reservationService =  $this->rRepository->getReservationWithService($id);
        #$this->authorize('reservation', $reservation);
        
        $this->rRepository->deleteReservation($reservation);

        $service = $this->bRepository->getServiceBusiness($reservationService->service->id);
        
        $this->nRepository->addNotificationBusiness($service->business->id, 'Rezerwacja oferty '.$reservationService->service->title.' została anulowana', 'redNotification');
        $this->nRepository->addNotificationEvent($reservationService->event_id, '['.$service->business->mainCategory->name.'] Rezerwacja oferty '.$reservationService->service->title.' została anulowana.' , 'redNotification');

        return redirect()->back();
    }

}
