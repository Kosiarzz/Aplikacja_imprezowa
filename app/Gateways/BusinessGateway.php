<?php

namespace App\Gateways; 

use App\Interfaces\BusinessRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;

class BusinessGateway { 
    
    public function __construct(BusinessRepositoryInterface $bRepository, UserRepositoryInterface $uRepository) 
    {
        $this->bRepository = $bRepository;
        $this->uRepository = $uRepository;
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

    public function getNotifications($request, $id)
    {
        if($request->user()->isBusiness())
        {
            $objects = $this->bRepository->getBusinessNotifications($id);
        }
        else
        {
            $objects = $this->uRepository->getUserNotifications($request);
        }

        return $objects;
    }
    
}


