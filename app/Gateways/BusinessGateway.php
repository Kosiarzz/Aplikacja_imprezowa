<?php

namespace App\Gateways; 

use App\Interfaces\BusinessRepositoryInterface;

class BusinessGateway { 
    
    public function __construct(BusinessRepositoryInterface $bRepository) 
    {
        $this->bRepository = $bRepository;
    }

    public function getReservations($request)
    {
        if($request->user()->isBusiness())
        {
            $objects = $this->bRepository->getBusinessReservations($request);
        }
        else
        {
            $objects = $this->bRepository->getUserReservations($request);
        }

        return $objects;
    }
    
}


