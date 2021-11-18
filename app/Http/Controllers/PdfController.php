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
    public function __construct(EventRepository $eRepository)
    {
        $this->eRepository = $eRepository;
    }
    
    public function createTaskPDF(Request $request){
        
        $tasks = $this->eRepository->getTasks();

        view()->share('tasks', $tasks);
        $pdf = PDF::loadView('event.PDF.tasks', $tasks);
  
        
        return $pdf->download($request->name.'.pdf');
    }

    public function createGuestPDF(Request $request){
        
        $guests = $this->eRepository->getGuests();

        view()->share('guests', $guests);
        $pdf = PDF::loadView('event.PDF.guests', $guests);
  
        
        return $pdf->download($request->name.'.pdf');
    }

    public function createFinancePDF(Request $request){
        
        $finances = $this->eRepository->getFinances();

        view()->share('finances', $finances);
        $pdf = PDF::loadView('event.PDF.finances', $finances);
  
        
        return $pdf->download($request->name.'.pdf');
    }
}
