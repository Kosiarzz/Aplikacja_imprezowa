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

}
