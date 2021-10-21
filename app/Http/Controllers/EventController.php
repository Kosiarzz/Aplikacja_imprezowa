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

    public function index()
    {
        return view('event.index');
    }
}
