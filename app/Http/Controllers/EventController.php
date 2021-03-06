<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;
use App\Repositories\ReservationRepository;
use App\Interfaces\UserRepositoryInterface;

use App\Extensions\Event\Dashboard;
use App\Extensions\Event\Finances;
use App\Extensions\Event\Guests;

use App\Models\GroupEvent;
use App\Models\Reservation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct(EventRepository $eRepository, ReservationRepository $reservationRepository, Dashboard $dashboard, Finances $finances, Guests $guests, UserRepositoryInterface $uRepository,)
    {
        $this->eRepository = $eRepository;
        $this->reservationRepository = $reservationRepository;
        $this->dashboard = $dashboard;
        $this->finances = $finances;
        $this->guests = $guests;
        $this->uRepository = $uRepository;
    }

    public function index($id)
    {    
        $event = $this->eRepository->getEvent($id);
        $tasks = $this->dashboard->getTasksProgress();
        $guests = $this->dashboard->getGuestsProgress();
        $finances = $this->dashboard->getFinancesProgress();

        $today = $this->eRepository->getTodayTasks();
        $tomorrow = $this->eRepository->getTommorowTasks();
        

        if(!session('event')){
            $events = $this->eRepository->getEvents(Auth::user()->id);
            return view('user.events', ['events' => $events]);
        }
        
        return view('event.index', [
            'event' => $event,
            'tasks' => $tasks,
            'guests' => $guests,
            'finances' => $finances,
            'today' => $today,
            'tomorrow' => $tomorrow,
        ]);
    }

    public function dashboardView()
    {    
        $event = $this->eRepository->getEventDashboard();
        $tasks = $this->dashboard->getTasksProgress();
        $guests = $this->dashboard->getGuestsProgress();
        $finances = $this->dashboard->getFinancesProgress();

        $today = $this->eRepository->getTodayTasks();
        $tomorrow = $this->eRepository->getTommorowTasks();
        
        return view('event.index', [
            'event' => $event,
            'tasks' => $tasks,
            'guests' => $guests,
            'finances' => $finances,
            'today' => $today,
            'tomorrow' => $tomorrow,
        ]);
    }
    
    public function createEventView()
    {
        $categories = $this->eRepository->getEventCategories();
        
        return view('event.createEvent', ['categories' => $categories]);
    }

    public function deleteEvent()
    {
        $this->eRepository->deleteEvent();
        
        $events = $this->uRepository->getEvents(Auth::user()->id);
        return view('user.events', ['events' => $events]);
    }

    public function addEvent(Request $request)
    {
        $event = $this->eRepository->createEvent($request);
        $tasks = $this->dashboard->getTasksProgress();
        $guests = $this->dashboard->getGuestsProgress();
        $finances = $this->dashboard->getFinancesProgress();

        $today = $this->eRepository->getTodayTasks();
        $tomorrow = $this->eRepository->getTommorowTasks();
        
        return view('event.index', [
            'event' => $event,
            'tasks' => $tasks,
            'guests' => $guests,
            'finances' => $finances,
            'today' => $today,
            'tomorrow' => $tomorrow,
        ]);
    }

    public function dateView(Request $request)
    {   
        return view('event.date');
    }

    public function financesView()
    {
        $finances = $this->eRepository->getFinances();
        $budgetDetails = $this->finances->getBudgetDetails();

        return view('event.finances', [
            'finances' => $finances,
            'budgetDetails' => $budgetDetails,
        ]);
    }

    public function guestView()
    {
        $guests = $this->eRepository->getGuests();
        $guestsDetails = $this->guests->getGuestsDetails();
        
        return view('event.guest', [
            'guests' => $guests,
            'guestsDetails' => $guestsDetails,
        ]);
    }

    public function editEventName(Request $request)
    {
        $this->eRepository->editEventName($request);

        return redirect()->back();
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

    public function editFinance(Request $request)
    {
        $events = $this->eRepository->editFinance($request);

        return redirect()->back();
    }
    
    public function deleteFinance(Request $request)
    {
        $events = $this->eRepository->deleteFinance($request);

        return redirect()->back();
    }

    public function statusFinance(Request $request)
    {
        $events = $this->eRepository->statusFinance($request);

        return redirect()->back();
    }

    public function editBudgetFinances(Request $request)
    {
        $events = $this->eRepository->editBudgetFinances($request);

        return redirect()->back();
    }

    public function statusGuest(Request $request)
    {
        $events = $this->eRepository->statusGuest($request);

        return redirect()->back();
    }

    public function editGuest(Request $request)
    {
        $events = $this->eRepository->editGuest($request);

        return redirect()->back();
    }
    
    public function deleteGuest(Request $request)
    {
        $events = $this->eRepository->deleteGuest($request);

        return redirect()->back();
    }

    public function serviceView()
    {
        $event = $this->eRepository->getEventDashboard();
        $services = $this->eRepository->getServices();
        $categories = $this->eRepository->getServiceCategories();
        $statisticCategories = $this->eRepository->getStatisticCategories($event->category->name);
        
        return view('event.services', ['services' => $services, 'mainCategories' => $categories, 'statisticCategories' => $statisticCategories]);
    }

    public function addMainCategoryGroup(Request $request)
    {
        $this->eRepository->addMainCategoryGroup($request);

        return redirect()->back();
    }

    public function serviceDetails($idCategory)
    {
        $services = $this->eRepository->getLikeableServices($idCategory);

        return view('event.servicesDetails', ['services' => $services, 'category' => $idCategory]);
    }

    public function notificationsView()
    {
        $notifications = $this->eRepository->getNotifications();
        
        $this->eRepository->setReadNotifications();

        return view('event.notifications', ['notificationsList' => $notifications]);
    }

    public function tasksView()
    {
        $tasks = $this->eRepository->getTasks();

        return view('event.tasks', ['tasks' => $tasks]);
    }

    public function reservationsView()
    {
        $reservations = $this->reservationRepository->getReservationsEvent(session('event'));

        return view('event.reservations', ['reservations' => $reservations]);
    }

    public function reservationFilter(Request $request)
    {
        $reservations = $this->eRepository->reservationFilter($request);

        return view('event.reservationsFilter', [
            'reservations' => $reservations,
            'request' => $request
        ]);
    }

}
 