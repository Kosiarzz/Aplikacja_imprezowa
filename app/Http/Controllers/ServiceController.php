<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BusinessRepositoryInterface;
use App\Gateways\BusinessGateway;

class ServiceController extends Controller
{
    public function __construct(BusinessRepositoryInterface $bRepository, BusinessGateway $bGateway)
    {
        $this->bRepository = $bRepository;
        $this->bGateway = $bGateway;
    }
    
    public function index($id)
    {     
        $data = $this->bRepository->getBusinessDetails($id);
        return view('service.index');
    }

    public function notifications()
    {     
        return view('notifications.index');
    }

    public function reservations()
    {     
        return view('reservations.index');
    }

    public function preview()
    {     
        return view('preview.index');
    }

    public function previewService()
    {     
        return view('previewService.index');
    }
    
    public function stats()
    {     
        return view('stats.index');
    }

}
