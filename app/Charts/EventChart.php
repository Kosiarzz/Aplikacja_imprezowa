<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\GroupEvent;

class EventChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $groupEvent = GroupEvent::with(['costs'])->where('type','cost')->where('event_id', session('event'))->get();
        
        $nameGroups = []; 
        $costs = []; 

        foreach($groupEvent as $group)
        {
            $nameGroups[] = $group->name;
            $costs[] = $group->costs->sum('cost');
        }

        return Chartisan::build()
        ->labels($nameGroups)
        ->dataset('Koszty', $costs);
    }
}