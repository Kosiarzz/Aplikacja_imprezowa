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

    public function category($selectCategory)
    {
        $category = $this->bRepository->getCategory($selectCategory);
        $categoryStats = $this->bRepository->getStatsCategory($selectCategory);
        $categoryAdditional = $this->bRepository->getAdditionalCategory($selectCategory);
        $categoryParty = $this->bRepository->getPartyCategory();

        return view('business.profile',  [
            'category' => $category, 
            'selectCategory' => $selectCategory, 
            'categoryStats' => $categoryStats,
            'categoryAdditional' => $categoryAdditional,
            'categoryParty' => $categoryParty,
        ]);
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

    

}
