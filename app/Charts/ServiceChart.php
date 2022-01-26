<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use App\Models\Statistic;

class ServiceChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $toDate = Carbon::now();
        $toDate->subDay(1);

        $fromDate = Carbon::createFromFormat('Y-m-d', $toDate->toDateString()); 
        $fromDate->subDay(7);

        $statistics = Statistic::whereBetween('date', [$fromDate , $toDate])->where('business_id', session('service'))->get();
        
        $labelsDate = []; 
        $views = []; 
        $reservations = []; 
        $likes = []; 

        $noDate = true;

        for($i=7; $i>0; $i--)
        {       
            $labelDate = Carbon::now();
            $labelDate->subDay($i);

            $noDate = true;

            foreach($statistics as $stat)
            {
                if(($stat->date) == ($labelDate->toDateString())){
                    $views[] = $stat->views;
                    $reservations[] = $stat->reservations;
                    $likes[] = $stat->likes;
                    $noDate = false;
                }

                unset($stat);
            }

            if($noDate)
            {
                $views[] = 0;
                $reservations[] = 0;
                $likes[] = 0;
            }

            $labelsDate[] = $labelDate->toDateString();
        }    


        return Chartisan::build()
        ->labels($labelsDate)
        ->dataset('Wyświetlenia', $views)
        ->dataset('Ulubione', $likes)
        ->dataset('Rezerwacje', $reservations);
    }
}