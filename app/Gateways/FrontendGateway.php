<?php

namespace App\Gateways; 

use App\Interfaces\FrontendRepositoryInterface;
use App\Repositories\ReservationRepository;

class FrontendGateway { 
    

    public function __construct(FrontendRepositoryInterface $fRepository, ReservationRepository $rRepository) 
    {
        $this->fRepository = $fRepository;
        $this->rRepository = $rRepository;
    }
    
    public function searchCities($request)
    {
        $term = $request->input('term');

        $results = array();

        $queries = $this->fRepository->getSearchCities($term);

        foreach($queries as $query)
        {
            $results[] = ['id' => $query->id, 'value' => $query->name];
        }

        return $results;
    } 

    public function getSearchResults($request)
    {
        $request->flash();

        $result = $this->fRepository->getSearchResults($request);

        return $result;
    }

    public function checkAvailableReservations($service_id, $request)
    {
        $dateFrom = date('Y-m-d', strtotime($request->input('dateFrom')));
        $dateTo = date('Y-m-d', strtotime($request->input('dateTo')));

        $reservations = $this->rRepository->getReservationsByServiceId($service_id);

        $available = true;
        foreach($reservations as $reservation)
        {
            if($dateFrom >= $reservation->date_from
                &&  $dateFrom <= $reservation->date_to
            )
            {
                $available = false; break;
            }
            elseif($dateTo >= $reservation->date_from
                &&  $dateTo <= $reservation->date_to
            )
            {
                $available = false; break;
            }
            elseif($dateFrom <= $reservation->date_from
                &&  $dateTo >= $reservation->date_to
            )
            {
                $available = false; break;
            }
        }

        return $available;
    }

}


