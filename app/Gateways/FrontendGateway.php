<?php

namespace App\Gateways; 

use App\Interfaces\FrontendRepositoryInterface;

class FrontendGateway { 
    

    public function __construct(FrontendRepositoryInterface $fRepository) 
    {
        $this->fRepository = $fRepository;
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

        if($request->input('city') != null)
        {
            $result = $this->fRepository->getSearchResults($request->input('city'));

            if($result)
            {
                foreach($result as $r)
                {
                    foreach($r->services as $k=>$service)
                    {
                        //Sprawdzenie ilości miejsc
                        if($request->input('check_in') > 0)
                        {
                            if($request->input('check_in') < $service->people_from && $request->input('check_out') > $service->people_to)
                            {
                                $r->services->forget($k);
                            }
                        }
                        
                        /*
                        //Sprawdzenie czy jest wolny termin
                        foreach($service->reservations as $reservation)
                        {
                            if($request->input('date') != $reservation->date)
                            {
                                $result->services->forget($k);
                            }
                        }
                        */ 
                    }
                }

                foreach($result as $r)
                {
                    if(count($r->services) > 0)
                    {
                        return $result; 
                    }

                    return false;   
                }          
            }
        }
        return false;
    }

    public function checkAvailableReservations($service_id, $request)
    {
        $dateFrom = date('Y-m-d', strtotime($request->input('dateFrom')));
        $dateTo = date('Y-m-d', strtotime($request->input('dateTo')));

        $reservations = $this->fRepository->getReservationsByServiceId($service_id);

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


