<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\FrontendRepositoryInterface;
use App\Gateways\FrontendGateway;
use App\Repositories\ServiceRepository;

class FrontendController extends Controller
{

    public function __construct(FrontendRepositoryInterface $fRepository, FrontendGateway $fGateway, ServiceRepository $sRepository)
    {
        $this->middleware('auth')->only(['addReservation','addComment','like','unlike']);

        $this->fRepository = $fRepository;
        $this->fGateway = $fGateway;
        $this->sRepository = $sRepository;
    }

    public function index()
    {
        $stats = $this->fRepository->getStatsMainPage();

        return view('frontend.index' , ['stats' => $stats]);
    }

    public function stats()
    {
        return view('frontend.stats');
    }

    public function businessIndex()
    {
        $data = $this->fRepository->getDataMainPage();
        $mainCategories = $this->fRepository->getCategoryMainPage();

        return view('frontend.search', [
            'businesses' => $data,
            'mainCategories' => $mainCategories,
        ]);
    }

    public function businessSearch(Request $request)
    {   
        $result = $this->fGateway->getSearchResults($request);
        $mainCategories = $this->fRepository->getCategoryMainPage();

        if(!$result->isEmpty())
        {
            if($request->mainCategory == 0){
                $category = 0;
            }
            else
            {
                $category = $result[0]->name_category;
            }

            return view('frontend.businessSearch', [
                'businesses' => $result,
                'category' => $category,
                'mainCategories' => $mainCategories,
                'request' => $request,
            ]);
        }

        return view('frontend.businessSearch', [
            'businesses' => $result,
            'category' => 0,
            'mainCategories' => $mainCategories,
            'request' => $request,
        ])->with('nobusiness', 'Brak wyników wyszykiwania.');
        
        #return redirect('/wyszukaj')->with('nobusiness', 'Brak wyników wyszykiwania.');
    }

    public function businessDetails($id)
    {
        //$data = $this->sRepository->getDashboard();

        $partyCategory = $this->fRepository->getPartyCategory($id);
        $additionalCategory = $this->fRepository->getAdditionalCategory($id);
        $userCategory = $this->fRepository->getUserCategory($id);

        $data = $this->fRepository->getBusinessDetails($id);
        return view('frontend.details', [
            'business' => $data,
            'partyCategory' => $partyCategory,
            'additionalCategory' => $additionalCategory,
            'userCategory' => $userCategory,
        ]);
    }
    
    public function serviceDetails($id)
    {
        $data = $this->fRepository->getServiceDetails($id);
        
        return view('frontend.serviceDetails', ['service' => $data]);
    }


    public function businessCompanyCategory()
    {
        return view('business.companyCategory');
    }

    public function businessProfile()
    {
        return view('business.profile');
    }

    public function user($id)
    {
        $user = $this->fRepository->getUser($id);

        return view('frontend.user', ['user' => $user]);
    }
}
