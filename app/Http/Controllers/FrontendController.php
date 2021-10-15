<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\FrontendRepositoryInterface;
use App\Gateways\FrontendGateway;

class FrontendController extends Controller
{

    public function __construct(FrontendRepositoryInterface $fRepository, FrontendGateway $fGateway)
    {
        $this->middleware('auth')->only(['addReservation','addComment','like','unlike']);

        $this->fRepository = $fRepository;
        $this->fGateway = $fGateway;
    }

    public function businessIndex()
    {
        $data = $this->fRepository->getDataMainPage();
        return view('frontend.index', ['businesses' => $data]);
    }

    public function businessDetails($id)
    {
        $data = $this->fRepository->getBusinessDetails($id);
        return view('frontend.details', ['business' => $data]);
    }
    
    public function roomDetails($id)
    {
        $data = $this->fRepository->getRoomDetails($id);
        
        return view('frontend.roomDetails', ['room' => $data]);
    }

    public function ajaxGetRoomReservations($id)
    {
        $reservations = $this->fRepository->getReservationsByRoomId($id);
        $this->fRepository->addNotification($id);

        return response()->json([
            'reservations' => $reservations
        ]);
    }

    public function businessCompanyCategory()
    {
        return view('business.companyCategory');
    }

    public function businessProfile()
    {
        return view('business.profile');
    }

    public function businessSearch(Request $request)
    {
        if($result = $this->fGateway->getSearchResults($request))
        {
            return view('frontend.businessSearch', ['businesses' => $result]);
        }

        return redirect('/')->with('nobusiness', 'Brak wyników wyszykiwania.');
    }

    public function user($id)
    {
        $user = $this->fRepository->getUser($id);

        return view('frontend.user', ['user' => $user]);
    }

    public function like($likeable_id, $type, Request $request)
    {
        $this->fRepository->like($likeable_id, $type, $request);

        return redirect()->back();
    }
    
    public function unlike($likeable_id, $type, Request $request)
    {
        $this->fRepository->unlike($likeable_id, $type, $request);
        
        return redirect()->back();
    }

    public function addComment($commentable_id, $type, Request $request)
    {
        $this->fRepository->addComment($commentable_id, $type, $request);
        
        return redirect()->back();
    }

    public function addReservation($room_id, $city_id, Request $request)
    {
        $available = $this->fGateway->checkAvailableReservations($room_id, $request);

        if($available)
        {
            $reservation = $this->fRepository->addReservation($room_id, $city_id, $request);
            return redirect()->route('roomDetails', ['id'=>$room_id,'#reservation']);
        }
        else
        {
            $request->session()->flash('reservationMsg', 'Błąd');
            return redirect()->route('roomDetails', ['id'=>$room_id,'#reservation']);
        }
    }
}
