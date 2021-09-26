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
                    foreach($r->rooms as $k=>$room)
                    {
                        //Sprawdzenie ilości miejsc
                        if($request->input('check_in') > 0)
                        {
                            if($request->input('check_in') < $room->people_from && $request->input('check_out') > $room->people_to)
                            {
                                $r->rooms->forget($k);
                            }
                        }
                        
                        /*
                        //Sprawdzenie czy jest wolny termin
                        foreach($room->reservations as $reservation)
                        {
                            if($request->input('date') != $reservation->date)
                            {
                                $result->rooms->forget($k);
                            }
                        }
                        */ 
                    }
                }

                foreach($result as $r)
                {
                    if(count($r->rooms) > 0)
                    {
                        return $result; 
                    }

                    return false;   
                }          
            }
        }
        return false;
    }
}


