<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\BusinessRepositoryInterface;
use App\Interfaces\ServiceRepositoryInterface;
use App\Repositories\ServiceRepository;
use App\Repositories\ReservationRepository;

use App\Models\Statistic;
use App\Charts\ServiceChart;

use Illuminate\Support\Carbon;


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
        return view('service.preview',[
            'data' => $data,
        ]);
    }

    public function dashboard()
    {     
        $data = $this->sRepository->getDashboard();
        
        return view('service.index');
    }

    public function notifications()
    {     
        $notifications = $this->sRepository->getNotifications();
        
        $this->sRepository->setReadNotifications($notifications);

        return view('service.notifications', ['notificationsList' => $notifications]);
    }

    public function reservations()
    {     
        $services = $this->sRepository->getServices();
        return view('service.reservations', ['services' => $services]);
    }

    public function reservationsDetails($id, $title)
    {     
        $reservations = $this->sRepository->getDetailsReservations($id);

        return view('service.reservationsDetails', ['reservations' => $reservations, 'id' => $id,'title' => $title]);
    }

    public function reservationDetailsFilters(Request $request)
    {     
        $reservations = $this->sRepository->getDetailsReservationsFilters($request);
        
        return view('service.reservationsDetails', ['reservations' => $reservations, 'id' => $request->serviceId, 'title' => $request->serviceTitle]);
    }

    public function preview()
    {     
        $data = $this->sRepository->getDashboard();

        return view('service.preview',[
            'data' => $data,
        ]);
    }

    public function previewService()
    {     
        $services = $this->sRepository->getBusinessServices();

        return view('service.previewService', ['services' => $services]);
    }
    
    public function stats()
    {        
        $stats = $this->sRepository->getToDayStats();

        return view('service.stats', ['stats' => $stats]);
    }

    public function calendar()
    {     
        return view('service.calendar');
    }

    public function serviceEdit($id)
    {     
        $business = $this->sRepository->getEditServiceDetails($id);

        return view('service.serviceEdit', ['business' => $business]);
    }

    public function serviceDelete($id)
    {     
        $this->sRepository->deleteService($id);
        
        $services = $this->sRepository->getBusinessServices();

        return view('service.previewService', ['services' => $services]);
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
