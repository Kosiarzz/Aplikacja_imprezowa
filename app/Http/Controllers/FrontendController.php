<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\FrontendRepositoryInterface;
use App\Gateways\FrontendGateway;

class FrontendController extends Controller
{

    public function __construct(FrontendRepositoryInterface $fRepository, FrontendGateway $fGateway)
    {
        $this->middleware('auth')->only(['makeReservation','addComment','like','unlike']);

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
        else
        {
            return redirect('/')->with('nobusiness', 'Brak wyników wyszykiwania.');
        }
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
}
