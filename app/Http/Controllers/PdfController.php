<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\EventRepository;
use App\Repositories\ReservationRepository;

use App\Extensions\Event\Dashboard;
use App\Extensions\Event\Finances;
use App\Extensions\Event\Guests;

use PDF;

class PdfController extends Controller
{
    public function __construct(EventRepository $eRepository, Guests $guests)
    {
        $this->eRepository = $eRepository;
        $this->guests = $guests;
    }
    
    public function createTaskPDF(Request $request){
        
        $tasks = $this->eRepository->getTasksPdf();

        view()->share('tasks', $tasks);
        $pdf = PDF::loadView('event.PDF.tasks', $tasks);
  
        
        return $pdf->download($request->name.'.pdf');
    }

    public function createGuestPDF(Request $request){
        
        $guests = $this->eRepository->getGuestsPdf();
        $guestsDetails = $this->guests->getGuestsDetails();

        $data = [
            'guests' => $guests,
            'guestsDetails'=> $guestsDetails
        ];

        view()->share('data', $data);
        $pdf = PDF::loadView('event.PDF.guests', $data);
  
        
        return $pdf->download($request->name.'.pdf');
    }

    public function createFinancePDF(Request $request){
        
        $finances = $this->eRepository->getFinancesPdf();

        view()->share('finances', $finances);
        $pdf = PDF::loadView('event.PDF.finances', $finances);
  
        
        return $pdf->download($request->name.'.pdf');
    }
}
