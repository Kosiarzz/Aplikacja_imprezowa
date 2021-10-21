<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(EventRepository $eRepository)
    {
        $this->eRepository = $eRepository;
    }

    public function index($id)
    {    
        $events = $this->eRepository->getEvent($id);
        
        return view('event.index', ['events' => $events]);
    }

    public function createEvent()
    {
        $categories = $this->eRepository->getEventCategories();

        return view('event.createEvent', ['categories' => $categories]);
    }

    public function addEvent(Request $request)
    {
        $events = $this->eRepository->createEvent($request);

        return view('event.index', ['events' => $events]);
    }

    
}
