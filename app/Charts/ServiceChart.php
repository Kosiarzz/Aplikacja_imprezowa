<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class ServiceChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        return Chartisan::build()
            ->labels(['20.11.2021', '21.11.2021', '22.11.2021', '23.11.2021', '24.11.2021', '25.11.2021', '26.11.2021'])
            ->dataset('Wyświetlenia', [12, 8, 10, 16, 8, 10, 7])
            ->dataset('Rezerwacje', [2, 1, 0, 2, 0, 1, 0])
            ->dataset('Ulubione', [1, 0, 2, 1, 0, 1, 3]);
    }
}