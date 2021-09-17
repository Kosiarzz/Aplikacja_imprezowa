<?php

namespace App\Repositories;

use App\Models\Business;
use App\Interfaces\FrontendRepositoryInterface;

class FrontendRepository implements FrontendRepositoryInterface
{
    public function getDataMainPage()
    {
        return Business::with(['city','photos','address','social'])->ordered()->paginate(5);
    }

    public function getBusinessDetails($id)
    {
        return Business::find($id);
    }
    
}
