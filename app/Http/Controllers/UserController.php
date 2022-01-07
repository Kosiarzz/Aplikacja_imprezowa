<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Gateways\BusinessGateway;
use App\Repositories\ReservationRepository;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $uRepository, BusinessGateway $bGateway, ReservationRepository $reservationRepository)
    {
        $this->uRepository = $uRepository;
        $this->bGateway = $bGateway;
        $this->reservationRepository = $reservationRepository;
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

    public function updateProfile(Request $request)
    {
        $this->uRepository->updateProfile($request);

        return redirect()->back();
    }

    public function events()
    {
        $events = $this->uRepository->getEvents(Auth::user()->id);
        return view('user.events', ['events' => $events, 'status' => 'actual']);
    }

    public function endEvents()
    {
        $events = $this->uRepository->getEndEvents(Auth::user()->id);
        return view('user.events', ['events' => $events, 'status' => 'end']);
    }

    public function notifications(Request $request)
    {
        $notifications = $this->bGateway->getNotifications($request, $request->user()->id);

        return view('user.notification',  ['notifications' => $notifications]);
    }

    public function reservation()
    {
        $reservations = $this->reservationRepository->getReservations(Auth::user()->id);

        return view('user.reservation', ['reservations' => $reservations]);
    }

    public function setReadNotification(Request $request)
    {
        $reservation = $this->uRepository->setReadNotification($request);
    }

    public function getNotShownNotify(Request $request)
    {
        $reservation = $this->uRepository->checkNotificationStatus($request);
    }

    //publiczne funkcje użytkowników
    public function findUserProfile($id)
    {
        $user  = $this->uRepository->getProfileUser($id);

        if($user == false)
        {
            return redirect()->back();
        }
        
        return view('frontend.user', ['user' => $user]);
    }
    
}
