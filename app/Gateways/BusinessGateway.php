<?php

namespace App\Gateways; 

use App\Interfaces\BusinessRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;

use App\Repositories\NotificationRepository;

class BusinessGateway { 
    
    public function __construct(BusinessRepositoryInterface $bRepository, UserRepositoryInterface $uRepository, NotificationRepository $notificationRepository) 
    {
        $this->bRepository = $bRepository;
        $this->uRepository = $uRepository;
        $this->notificationRepository = $notificationRepository;
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
            $objects = $this->notificationRepository->getNotifications($id, 'App\Models\Business');
        }
        else
        {
            $objects = $this->notificationRepository->getNotifications($id, 'App\Models\User');
        }

        return $objects;
    }
    
}


