<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;
use App\Repositories\ReservationRepository;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(EventRepository $eRepository, ReservationRepository $reservationRepository)
    {
        $this->eRepository = $eRepository;
        $this->reservationRepository = $reservationRepository;
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

    public function editGroup(Request $request)
    {
        $events = $this->eRepository->editGroup($request);

        return redirect()->back();
    }

    public function deleteGroup(Request $request)
    {
        $events = $this->eRepository->deleteGroup($request);

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

    public function editTask(Request $request)
    {
        $events = $this->eRepository->editTask($request);

        return redirect()->back();
    }
    
    public function deleteTask(Request $request)
    {
        $events = $this->eRepository->deleteTask($request);

        return redirect()->back();
    }

    public function statusTask(Request $request)
    {
        $events = $this->eRepository->statusTask($request);

        return redirect()->back();
    }

    public function serviceView()
    {
        $services = $this->eRepository->getServices();

        return view('event.services', ['services' => $services]);
    }

    public function serviceDetails($idCategory)
    {
        $services = $this->eRepository->getLikeableServices($idCategory);

        return view('event.servicesDetails', ['services' => $services]);
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
        $reservations = $this->reservationRepository->getReservations(session('event'));

        return view('event.reservations', ['reservations' => $reservations]);
    }

}
