<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BusinessRepositoryInterface;
use App\Interfaces\ServiceRepositoryInterface;
use App\Repositories\ServiceRepository;
use App\Repositories\ReservationRepository;

class ServiceController extends Controller
{
    public function __construct(ServiceRepositoryInterface $sRepository)
    {
        $this->sRepository = $sRepository;
    }
    
    public function index($id)
    {     
        $data = $this->sRepository->getBusinessDetails($id);

        session(['service' => $data->id]);
        return view('service.index');
    }

    public function dashboard()
    {     
        $data = $this->sRepository->getDashboard();
        
        return view('service.index');
    }

    public function notifications()
    {     
        $notifications = $this->sRepository->getNotifications();
        
        #$this->eRepository->setReadNotifications($notifications);

        return view('service.notifications', ['notificationsList' => $notifications]);
    }

    public function reservations()
    {     
        $reservations = $this->sRepository->getBusinessReservations();

        return view('service.reservations', ['business' => $reservations]);
    }

    public function preview()
    {     
        return view('service.preview');
    }

    public function previewService()
    {     
        $services = $this->sRepository->getBusinessServices();

        return view('service.previewService', ['services' => $services]);
    }
    
    public function stats()
    {     
        return view('service.stats');
    }

    public function serviceEdit($id)
    {     
        return view('service.serviceEdit');
    }

    public function serviceAdd()
    {     
        $business = $this->sRepository->getMainCategory();

        return view('service.serviceAdd', ['business' => $business]);
    }

    public function addService(Request $request)
    {     
        $service = $this->sRepository->addService($request);

        return view('service.serviceDetails', ['service' => $service]);
    }

    public function serviceDetails($id)
    {     
        $service = $this->sRepository->getServiceDetails($id);

        return view('service.serviceDetails', ['service' => $service]);
    }


    

}
