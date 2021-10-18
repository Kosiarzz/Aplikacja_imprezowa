<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Gateways\BusinessGateway;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $uRepository, BusinessGateway $bGateway)
    {
        $this->uRepository = $uRepository;
        $this->bGateway = $bGateway;
    }

    public function index()
    {
        return view('user.index');
    }

    public function profile()
    {
        $data = $this->uRepository->getProfileUser(Auth::user()->id);
        return view('user.profile', ['user' => $data]);
    }

    public function like()
    {
        $data = $this->uRepository->getLikeableUser(Auth::user()->id);
        return view('user.like', ['user' => $data]);
    }

    public function events()
    {
        return view('user.events');
    }

    public function notifications(Request $request)
    {
        $notifications = $this->bGateway->getNotifications($request, $request->user()->id);

        return view('user.notification',  ['notifications' => $notifications]);
    }

    public function reservation()
    {
        $reservations = $this->uRepository->getReservations(Auth::user()->id);

        return view('user.reservation', ['reservations' => $reservations]);
    }

    public function deleteReservation($id)
    {
        $reservation = $this->uRepository->getReservation($id);

        $this->authorize('reservation', $reservation);
        
        $this->uRepository->deleteReservation($reservation);
        $this->uRepository->addNotification($reservation, 'Użytkownik odwołał rezerwacje');
        
        return redirect()->back();
    }

    public function setReadNotification(Request $request)
    {
        $reservation = $this->uRepository->setReadNotification($request);
    }

    public function getNotShownNotify(Request $request)
    {
        $reservation = $this->uRepository->checkNotificationStatus($request);
    }

    
}
