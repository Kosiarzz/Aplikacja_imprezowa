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
    public function __construct(ServiceRepositoryInterface $sRepository, BusinessRepositoryInterface $bRepository)
    {
        $this->sRepository = $sRepository;
        $this->bRepository = $bRepository;
    }
    
    public function index($id)
    {     
        $data = $this->sRepository->getBusinessDetails($id);
        session(['service' => $data->id]);
        
        $rate = $this->sRepository->getRate($data);
        $partyCategory = $this->sRepository->getPartyCategory();
        $additionalCategory = $this->sRepository->getAdditionalCategory();
        $userCategory = $this->sRepository->getUserCategory();

        
        return view('service.preview',[
            'business' => $data,
            'rate' => $rate,
            'partyCategory' => $partyCategory,
            'additionalCategory' => $additionalCategory,
            'userCategory' => $userCategory,
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

        return view('service.reservationsDetails', [
            'reservations' => $reservations, 
            'id' => $id,
            'title' => $title,
            'request' => null,
        ]);
    }

    public function reservationDetailsFilters(Request $request)
    {     
        $reservations = $this->sRepository->getDetailsReservationsFilters($request);
        
        return view('service.reservationsDetails', [
            'reservations' => $reservations, 
            'id' => $request->serviceId,
            'title' => $request->serviceTitle,
            'request' => $request
        ]);
    }

    public function preview()
    {     
        $data = $this->sRepository->getDashboard();
        $rate = $this->sRepository->getRate($data);
        $partyCategory = $this->sRepository->getPartyCategory();
        $additionalCategory = $this->sRepository->getAdditionalCategory();
        $userCategory = $this->sRepository->getUserCategory();

        return view('service.preview',[
            'business' => $data,
            'rate' => $rate,
            'partyCategory' => $partyCategory,
            'additionalCategory' => $additionalCategory,
            'userCategory' => $userCategory,
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

    public function statsOffers()
    {        
        $stats = $this->sRepository->getToDayStatsOffers();
        $moreStats = $this->sRepository->getToLastSevenDaysStatsOffers();

        return view('service.statsOffers', [
            'stats' => $stats,
            'moreStats' => $moreStats,
        ]);
    }

    public function statsCustom()
    {        
        $stats = $this->sRepository->getToDayStats();
        $services = $this->sRepository->getServices();

        return view('service.statsCustom', [
            'stats' => $stats,
            'services' => $services
        ]);
    }

    public function statsCustomBusiness(Request $request)
    {        
        $stats = $this->sRepository->getStatsBusiness($request);
        $services = $this->sRepository->getServices();

        return view('service.statsCustom', [
            'statsBusiness' => $stats,
            'services' => $services,
            'request' => $request
        ]);
    }

    public function statsCustomService(Request $request)
    {        
        $stats = $this->sRepository->getStatsService($request);
        $services = $this->sRepository->getServices();

        return view('service.statsCustom', [
            'statsService' => $stats,
            'services' => $services,
            'request' => $request
        ]);
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

    public function businessDelete($id)
    {     
        $this->sRepository->deleteBusiness($id);
        
        $businesses = $this->bRepository->getAllBusiness();

        return redirect()->route('business.index', ['businesses' => $businesses]);
    }

    public function businessEdit($id)
    {     
        $business = $this->sRepository->editBusiness($id);
        $category = $this->bRepository->getCategory($business->name_category);
        $categoryStats = $this->bRepository->getStatsCategory($business->name_category);
        $categoryAdditional = $this->bRepository->getAdditionalCategory($business->name_category);
        $categoryParty = $this->bRepository->getPartyCategory();
        $categoryBusiness = $this->sRepository->getBusinessCategory();

        return view('service.editBusiness', [
            'business' => $business,
            'category' => $category, 
            'categoryStats' => $categoryStats,
            'categoryAdditional' => $categoryAdditional,
            'categoryParty' => $categoryParty,
            'categoryBusiness' => $categoryBusiness,
        ]);
    }

    public function businessEditSave(Request $request)
    {     
        $this->sRepository->businessEditSave($request);

        $data = $this->sRepository->getDashboard();
        $rate = $this->sRepository->getRate($data);
        $partyCategory = $this->sRepository->getPartyCategory();
        $additionalCategory = $this->sRepository->getAdditionalCategory();
        $userCategory = $this->sRepository->getUserCategory();

        return view('service.preview',[
            'business' => $data,
            'rate' => $rate,
            'partyCategory' => $partyCategory,
            'additionalCategory' => $additionalCategory,
            'userCategory' => $userCategory,
        ]);
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

    public function editService(Request $request)
    {     
        $service = $this->sRepository->editService($request);

        return view('service.serviceDetails', ['service' => $service]);
    }

    public function serviceDetails($id)
    {     
        $service = $this->sRepository->getServiceDetails($id);

        return view('service.serviceDetails', ['service' => $service]);
    }
}
