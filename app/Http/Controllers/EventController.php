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

    public function createEventView()
    {
        $categories = $this->eRepository->getEventCategories();

        return view('event.createEvent', ['categories' => $categories]);
    }

    public function addEvent(Request $request)
    {
        $events = $this->eRepository->createEvent($request);

        return view('event.index', ['events' => $events]);
    }

    public function dateView()
    {
        return view('event.date');
    }

    public function financesView()
    {
        $finances = $this->eRepository->getFinances();

        return view('event.finances', ['finances' => $finances]);
    }

    public function guestView()
    {
        $guests = $this->eRepository->getGuests();

        return view('event.guest', ['guests' => $guests]);
    }

    public function addGroup(Request $request)
    {
        $events = $this->eRepository->addGroup($request);

        return redirect()->back();
    }

    public function addGuest(Request $request)
    {
        $events = $this->eRepository->addGuest($request);

        return redirect()->back();
    }

    public function addFinance(Request $request)
    {
        $events = $this->eRepository->addFinance($request);

        return redirect()->back();
    }

    public function addTask(Request $request)
    {
        $events = $this->eRepository->addTask($request);

        return redirect()->back();
    }


    public function likeView()
    {
        $likes = $this->eRepository->getLikeBusiness();

        return view('event.like', ['likes' => $likes]);
    }

    public function notificationsView()
    {
        return view('event.notifications');
    }

    public function tasksView()
    {
        $tasks = $this->eRepository->getTasks();

        return view('event.tasks', ['tasks' => $tasks]);
    }

    public function reservationsView()
    {
        return view('event.reservations');
    }

}
