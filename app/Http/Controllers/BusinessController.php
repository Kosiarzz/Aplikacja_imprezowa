<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BusinessRepositoryInterface;
use App\Gateways\BusinessGateway;

class BusinessController extends Controller
{

    public function __construct(BusinessRepositoryInterface $bRepository, BusinessGateway $bGateway)
    {
        $this->bRepository = $bRepository;
        $this->bGateway = $bGateway;
    }

    public function index()
    {
        $businesses = $this->bRepository->getAllBusiness();

        return view('business.index',  ['businesses' => $businesses]);
    }

    public function businessDetails($id)
    {
        $data = $this->bRepository->getBusinessDetails($id);
        return view('business.details', ['business' => $data]);
    }

    public function reservations(Request $request)
    {
        $reservations = $this->bGateway->getReservations($request);

        return view('business.reservations', ['business' => $reservations]);
    }

    public function category()
    {
        $category = $this->bRepository->getCategory();
        return view('business.profile',  ['category' => $category]);
    }

    public function addBusiness(Request $request)
    {
        
        $this->bRepository->addBusiness($request);

        $businesses = $this->bRepository->getAllBusiness();

        return redirect(route('business.index'))->with('brak', 'brak');
    }

    public function notifications(Request $request)
    {
        $notifications = $this->bGateway->getNotifications($request, session('business'));

        return view('business.notifications',  ['notifications' => $notifications]);
    }

    public function confirmReservation($id)
    {
        $reservation = $this->bRepository->getReservation($id);

        $this->authorize('reservation', $reservation);

        $this->bRepository->confirmReservation($reservation);
        $this->bRepository->addNotification($reservation, 'Rezerwacja zaakceptowana');

        return redirect()->back();
    }
    
    public function deleteReservation($id)
    {
        $reservation = $this->bRepository->getReservation($id);

        $this->authorize('reservation', $reservation);
        
        $this->bRepository->deleteReservation($reservation);
        $this->bRepository->addNotification($reservation, 'Rezerwacja odrzucona');

        return redirect()->back();
    }

}
