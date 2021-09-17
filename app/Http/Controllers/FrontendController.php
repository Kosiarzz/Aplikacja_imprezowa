<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\FrontendRepositoryInterface;

class FrontendController extends Controller
{

    public function __construct(FrontendRepositoryInterface $repositroy)
    {
        $this->repository = $repositroy;
    }

    public function businessIndex()
    {
        $data = $this->repository->getDataMainPage();
        return view('frontend.index', ['businesses' => $data]);
    }

    public function businessDetails($id)
    {
        $data = $this->repository->getBusinessDetails($id);
        return view('frontend.details', ['business' => $data]);
    }


    public function businessCompanyCategory()
    {
        return view('business.companyCategory');
    }

    public function businessProfile()
    {
        return view('business.profile');
    }




}
