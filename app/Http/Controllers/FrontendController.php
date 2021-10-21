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

    public function index()
    {
        return view('frontend.index');
    }

    public function businessIndex()
    {
        $data = $this->fRepository->getDataMainPage();

        return view('frontend.search', ['businesses' => $data]);
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
}
