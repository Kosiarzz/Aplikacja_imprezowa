<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use App\Models\Cost;
use App\Models\GroupEvent;
use App\Models\Guest;
use App\Models\Group;
use App\Models\Task;
use App\Models\Notification;
use App\Models\GroupCategory;
use App\Models\StatisticsCategory;
use App\Models\Reservation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EventRepository
{
    public function getEventCategories()
    {
        return Group::with(['groupCategory' => function($q) 
            {
                $q->where('type','default')->with('category');
            }])->where('type', 'partyCategory')->where('name', 'partyCategory')->get();
    }

    public function getServiceCategories()
    {
        return Group::with(['groupCategory.category'])->where('type','mainCategory')->where('name', 'mainCategory')->get();
    }

    public function getStatisticCategories($categoryName)
    {
        return $tt = StatisticsCategory::where('type', $categoryName)->with(['category'])->orderBy('stats','desc')->get();
    }

    public function statusTask($request)
    {
        Task::where('id', $request->id)->update(['status' => $request->status]);
    }

    public function statusFinance($request)
    {
        Cost::where('id', $request->id)->update(['status' => $request->status]);
    }

    public function editBudgetFinances($request)
    {
        Event::where('id', session('event'))->update(['budget' => $request->budget]);
    }

    public function statusGuest($request)
    {
        Guest::where('id', $request->id)->update(['confirmation' => $request->status]);
    }

    public function editEventName($request)
    {
        Event::where('id', session('event'))->update(['name' => $request->name, 'date_event' => $request->date]);
    }

    public function reservationFilter($request)
    {

        $reservations = Reservation::with(['service.business.photos', 'service.business.contactable', 'service.business.address'])->where('event_id', session('event'))->get();

        if(!is_null($request->dateFrom))
        {
            $reservations = $reservations->where('date_from', '>=', $request->dateFrom);
        }

        if(!is_null($request->dateTo))
        {
            $reservations = $reservations->where('date_to', '<=', $request->dateTo);
        }

        if(!is_null($request->status))
        {
            $reservations = $reservations->where('status', $request->status);
        }

        if(!is_null($request->business))
        {
            foreach($reservations as $key => $reservation)
            {
                if($reservation->service->business->name != $request->business)
                {
                    $reservations->forget($key);
                }
            }
        }

        if(!is_null($request->city))
        {
            foreach($reservations as $key => $reservation)
            {
                if($reservation->service->business->city->name != $request->city)
                {
                    $reservations->forget($key);
                }
            }
        }
        
        if(!is_null($request->service))
        {
            foreach($reservations as $key => $reservation)
            {
                if($reservation->service->business->mainCategory->name != $request->service)
                {
                    $reservations->forget($key);
                }
            }
        }

        return $reservations;
    }

    public function createEvent($request)
    {

        $event = new Event();
        $event->name = $request->name;
        $event->budget = $request->budget;
        $event->date_event = $request->date;
        $event->category_id = $request->party;
        $event->user_id = Auth::user()->id;
        $event->save();

        session(['event' => $event->id]);
        if($request->party == 1) //wesele
        {    
            $groupCosts = new GroupEvent();
            $groupCosts->name = "Opłaty";
            $groupCosts->type = "cost";
            $groupCosts->color = "#F64C32";
            $groupCosts->event_id = $event->id;
            $groupCosts->save();

            $groupCostsService = new GroupEvent();
            $groupCostsService->name = "Usługi";
            $groupCostsService->type = "cost";
            $groupCostsService->color = "#F64C32";
            $groupCostsService->event_id = $event->id;
            $groupCostsService->save();

            $groupCostsShops = new GroupEvent();
            $groupCostsShops->name = "Sklepy";
            $groupCostsShops->type = "cost";
            $groupCostsShops->color = "#F64C32";
            $groupCostsShops->event_id = $event->id;
            $groupCostsShops->save();


            $dataCost = [
                ['name' => 'Tort',             'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Kurs tańca',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Zaproszenia',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
            ];

            Cost::insert($dataCost);

            $dataCostService = [
                ['name' => 'Sala weselna',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Dekoracja sali',     'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Dekoracja kościoła', 'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Fotograf',               'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Catering',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Zespół muzyczny',            'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Wynajem auta',          'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Fryzjer',          'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Makijażystka',          'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
            ];

            Cost::insert($dataCostService);

            $dataCostShops = [
                ['name' => 'Kupić suknie ślubną',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
                ['name' => 'Kupić garnitur do ślubu',     'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
                ['name' => 'Kupić obrączki', 'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
            ];

            Cost::insert($dataCostShops);


            $groupTasks = new GroupEvent();
            $groupTasks->name = "Zadania";
            $groupTasks->type = "task";
            $groupTasks->color = "#09A4DB";
            $groupTasks->event_id = $event->id;
            $groupTasks->save();

            $groupTasksReservations = new GroupEvent();
            $groupTasksReservations->name = "Rezerwacje";
            $groupTasksReservations->type = "task";
            $groupTasksReservations->color = "#09A4DB";
            $groupTasksReservations->event_id = $event->id;
            $groupTasksReservations->save();

            $groupTasksDocuments = new GroupEvent();
            $groupTasksDocuments->name = "Dokumenty";
            $groupTasksDocuments->type = "task";
            $groupTasksDocuments->color = "#09A4DB";
            $groupTasksDocuments->event_id = $event->id;
            $groupTasksDocuments->save();

            $dataTasks = [
                ['name' => 'Ustalić charakter imprezy',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasks->id],
                ['name' => 'Określić planowaną liczbę gości', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wybrać miejsce ślubu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wybrać salę weselną', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zapisać się na nauki przedmałżeńskie', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wybrać świadków', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić listę gości', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wysłać zaproszenia', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić muzykę na wesele', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wybrać piosenkę na pierwszy taniec', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Rozpocząć kurs tańca', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić menu weselne', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić scenariusz wesela', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zaplanować podróż poślubną', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić kto będzie odpowiedzialny za prezenty', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Buty na zmianę', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
            ];

            Task::insert($dataTasks);

            $dataTasksReservations = [
                ['name' => 'Zarezerwować datę ślubu w kościele',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować miejsce ślubu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować fotografa', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować zespół muzyczny', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować dekoratora', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować catering', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować samochód do ślubu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować fryzjera', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować makijarzystkę', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować transport dla gości', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować nocleg dla gości', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                
            ];


            Task::insert($dataTasksReservations);

            $dataTasksDocuments = [
                ['name' => 'Dowody osobiste narzeczonych',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasksDocuments->id],
                ['name' => 'Dowody osobiste świadków', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
                ['name' => 'Metryki chrztu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
                ['name' => 'Zaświadczenia o bierzmowaniu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
                ['name' => 'Świadectwa nauki religii (w zależności od wymagań parafii)', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
                ['name' => 'Licencja - zgody proboszczów na ślub w innej parafii niż parafie narzeczonych', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
                ['name' => 'Potwierdzenie odbycia nauk przedmałżeńskich i spotkań w poradni rodzinnej', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
                ['name' => 'Zaświadczenie o wygłoszeniu zapowiedzi (w przypadku wygłoszenia w innej parafii)', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
                ['name' => 'Zaświadczenia o odbyciu spowiedzi', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
                ['name' => 'Zaświadczenie z Urzędu Stanu Cywilnego o braku okoliczności wykluczających zawarcie związku małżeńskiego', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
                ['name' => 'Skrócone odpisy aktów urodzenia', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
                ['name' => 'Dowody osobiste świadków', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksDocuments->id],
            ];

            Task::insert($dataTasksDocuments);

            $groupGuestsFamily = new GroupEvent();
            $groupGuestsFamily->name = "Rodzina";
            $groupGuestsFamily->type = "guest";
            $groupGuestsFamily->event_id = $event->id;
            $groupGuestsFamily->save();
    
            $groupGuestsFriends = new GroupEvent();
            $groupGuestsFriends->name = "Znajomi";
            $groupGuestsFriends->type = "guest";
            $groupGuestsFriends->event_id = $event->id;
            $groupGuestsFriends->save();
    
            $groupService = new GroupEvent();
            $groupService->name = "Usługi";
            $groupService->type = "service";
            $groupService->event_id = $event->id;
            $groupService->save();

            $serviceForEvent = ['Fotograf', 'Catering', 'Zespół muzyczny', 'Auto do wynajęcia', 'Salon sukien', 'Sala', 'Dekoracje'];
            $dataService = [];

            foreach($serviceForEvent as $sForEvent)
            {
                $category = Category::where('name', $sForEvent)->get();
                
                if(!is_null($category))
                {
                    foreach($category as $cat)
                    {
                        $dataService[] = ['group_id' => $groupService->id, 'icon_name' => 'brak', 'type' => 'service', 'category_id' => $cat->id];

                        StatisticsCategory::firstOrCreate([
                            "category_id" => $cat->id,
                            "type" => 'Wesele',
                        ])->increment('stats', 1);
                    } 
                } 
            }

            $groupGuestsFriends = new GroupEvent();
            $groupGuestsFriends->name = "Nocleg";
            $groupGuestsFriends->type = "guest";
            $groupGuestsFriends->event_id = $event->id;
            $groupGuestsFriends->save();

            $groupGuestsFriends = new GroupEvent();
            $groupGuestsFriends->name = "Transport";
            $groupGuestsFriends->type = "guest";
            $groupGuestsFriends->event_id = $event->id;
            $groupGuestsFriends->save();
        }





        if($request->party == 2) //urodziny
        {
            $groupCosts = new GroupEvent();
            $groupCosts->name = "Opłaty";
            $groupCosts->type = "cost";
            $groupCosts->color = "#F64C32";
            $groupCosts->event_id = $event->id;
            $groupCosts->save();

            $groupCostsService = new GroupEvent();
            $groupCostsService->name = "Usługi";
            $groupCostsService->type = "cost";
            $groupCostsService->color = "#F64C32";
            $groupCostsService->event_id = $event->id;
            $groupCostsService->save();

            $groupCostsShops = new GroupEvent();
            $groupCostsShops->name = "Sklepy";
            $groupCostsShops->type = "cost";
            $groupCostsShops->color = "#F64C32";
            $groupCostsShops->event_id = $event->id;
            $groupCostsShops->save();

            //Opłaty
            $dataCost = [
                ['name' => 'Tort',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Kurs tańca',     'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Zaproszenia',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
            ];

            Cost::insert($dataCost);

            //Usługi
            $dataCostService = [
                ['name' => 'Sala urodzinowa',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Dekoracja sali',     'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Fotograf',               'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Catering',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Zespół muzyczny',            'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Fryzjer',          'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
            ];

            Cost::insert($dataCostService);

            //Sklepy
            $dataCostShops = [
                ['name' => 'Kupić ubranie na urodziny',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
            ];

            Cost::insert($dataCostShops);


            

            $groupTasks = new GroupEvent();
            $groupTasks->name = "Zadania";
            $groupTasks->type = "task";
            $groupTasks->color = "#09A4DB";
            $groupTasks->event_id = $event->id;
            $groupTasks->save();

            $groupTasksReservations = new GroupEvent();
            $groupTasksReservations->name = "Rezerwacje";
            $groupTasksReservations->type = "task";
            $groupTasksReservations->color = "#09A4DB";
            $groupTasksReservations->event_id = $event->id;
            $groupTasksReservations->save();

            $groupTasksDocuments = new GroupEvent();
            $groupTasksDocuments->name = "Dokumenty";
            $groupTasksDocuments->type = "task";
            $groupTasksDocuments->color = "#09A4DB";
            $groupTasksDocuments->event_id = $event->id;
            $groupTasksDocuments->save();

            $dataTasks = [
                ['name' => 'Określić planowaną liczbę gości', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wybrać miejsce urodzin', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić listę gości', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wysłać zaproszenia', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić muzykę', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Rozpocząć kurs tańca', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić menu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
            ];

            Task::insert($dataTasks);

            $dataTasksReservations = [
                ['name' => 'Zarezerwować sale', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować fotografa', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować zespół muzyczny', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować dekoratora', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować catering', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować fryzjera', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],      
            ];


            Task::insert($dataTasksReservations);

            $dataTasksDocuments = [
                ['name' => 'Dowód osobisty',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasksDocuments->id],
            ];

            Task::insert($dataTasksDocuments);


            
            $groupGuestsFamily = new GroupEvent();
            $groupGuestsFamily->name = "Rodzina";
            $groupGuestsFamily->type = "guest";
            $groupGuestsFamily->event_id = $event->id;
            $groupGuestsFamily->save();
    
            $groupGuestsFriends = new GroupEvent();
            $groupGuestsFriends->name = "Znajomi";
            $groupGuestsFriends->type = "guest";
            $groupGuestsFriends->event_id = $event->id;
            $groupGuestsFriends->save();
    
            $groupService = new GroupEvent();
            $groupService->name = "Usługi";
            $groupService->type = "service";
            $groupService->event_id = $event->id;
            $groupService->save();


            $serviceForEvent = ['Fotograf', 'Catering', 'DJ', 'Sala', 'Dekoracje'];
            $dataService = [];

            foreach($serviceForEvent as $sForEvent)
            {
                $category = Category::where('name', $sForEvent)->get();
                
                if(!is_null($category))
                {
                    foreach($category as $cat)
                    {
                        $dataService[] = ['group_id' => $groupService->id, 'icon_name' => 'brak', 'type' => 'service', 'category_id' => $cat->id];

                        StatisticsCategory::firstOrCreate([
                            "category_id" => $cat->id,
                            "type" => 'Urodziny',
                        ])->increment('stats', 1);
                    } 
                } 
            }

        }

        if($request->party == 3) //komunia święta
        {
            $groupCosts = new GroupEvent();
            $groupCosts->name = "Opłaty";
            $groupCosts->type = "cost";
            $groupCosts->color = "#F64C32";
            $groupCosts->event_id = $event->id;
            $groupCosts->save();

            $groupCostsService = new GroupEvent();
            $groupCostsService->name = "Usługi";
            $groupCostsService->type = "cost";
            $groupCostsService->color = "#F64C32";
            $groupCostsService->event_id = $event->id;
            $groupCostsService->save();

            $groupCostsShops = new GroupEvent();
            $groupCostsShops->name = "Sklepy";
            $groupCostsShops->type = "cost";
            $groupCostsShops->color = "#F64C32";
            $groupCostsShops->event_id = $event->id;
            $groupCostsShops->save();

            //Opłaty
            $dataCost = [
                ['name' => 'Tort',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Zaproszenia',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
            ];

            Cost::insert($dataCost);

            //Usługi
            $dataCostService = [
                ['name' => 'Sala',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Dekoracja sali',     'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Dekoracje kościoła', 'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Fotograf',               'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Catering',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Fryzjer',          'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Animator',          'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
            
            ];

            Cost::insert($dataCostService);

            //Sklepy
            $dataCostShops = [
                ['name' => 'Kupić strój dziecku',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
                ['name' => 'Różaniec',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
                ['name' => 'Modlitewnik',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
                ['name' => 'Świeca',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
                ['name' => 'Medalik',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
            
            ];

            Cost::insert($dataCostShops);


            $groupTasks = new GroupEvent();
            $groupTasks->name = "Zadania";
            $groupTasks->type = "task";
            $groupTasks->color = "#09A4DB";
            $groupTasks->event_id = $event->id;
            $groupTasks->save();

            $groupTasksReservations = new GroupEvent();
            $groupTasksReservations->name = "Rezerwacje";
            $groupTasksReservations->type = "task";
            $groupTasksReservations->color = "#09A4DB";
            $groupTasksReservations->event_id = $event->id;
            $groupTasksReservations->save();

            $groupTasksDocuments = new GroupEvent();
            $groupTasksDocuments->name = "Dokumenty";
            $groupTasksDocuments->type = "task";
            $groupTasksDocuments->color = "#09A4DB";
            $groupTasksDocuments->event_id = $event->id;
            $groupTasksDocuments->save();

            $dataTasks = [
                ['name' => 'Zarezerwować salę', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wysłać zaproszenia', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić menu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
            ];

            Task::insert($dataTasks);

            $dataTasksReservations = [
                ['name' => 'Zarezerwować sale', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować fotografa', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować dekoratora', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować catering', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować fryzjera', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],      
            ];


            Task::insert($dataTasksReservations);

            $dataTasksDocuments = [
                ['name' => 'Metryka chrztu dziecka',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasksDocuments->id],
            ];

            Task::insert($dataTasksDocuments);

            $groupGuestsFamily = new GroupEvent();
            $groupGuestsFamily->name = "Goście";
            $groupGuestsFamily->type = "guest";
            $groupGuestsFamily->event_id = $event->id;
            $groupGuestsFamily->save();
    
            $groupService = new GroupEvent();
            $groupService->name = "Usługi";
            $groupService->type = "service";
            $groupService->event_id = $event->id;
            $groupService->save();

            $serviceForEvent = ['Fotograf', 'Kamerzysta', 'Catering', 'Sala', 'Atrakcje'];
            $dataService = [];

            foreach($serviceForEvent as $sForEvent)
            {
                $category = Category::where('name', $sForEvent)->get();
                
                if(!is_null($category))
                {
                    foreach($category as $cat)
                    {
                        $dataService[] = ['group_id' => $groupService->id, 'icon_name' => 'brak', 'type' => 'service', 'category_id' => $cat->id];

                        StatisticsCategory::firstOrCreate([
                            "category_id" => $cat->id,
                            "type" => 'Komunia',
                        ])->increment('stats', 1);
                    } 
                } 
            }
        }

        if($request->party == 4) //chrzest
        {
            $groupCosts = new GroupEvent();
            $groupCosts->name = "Opłaty";
            $groupCosts->type = "cost";
            $groupCosts->color = "#F64C32";
            $groupCosts->event_id = $event->id;
            $groupCosts->save();

            $groupCostsService = new GroupEvent();
            $groupCostsService->name = "Usługi";
            $groupCostsService->type = "cost";
            $groupCostsService->color = "#F64C32";
            $groupCostsService->event_id = $event->id;
            $groupCostsService->save();

            $groupCostsShops = new GroupEvent();
            $groupCostsShops->name = "Sklepy";
            $groupCostsShops->type = "cost";
            $groupCostsShops->color = "#F64C32";
            $groupCostsShops->event_id = $event->id;
            $groupCostsShops->save();

            //Opłaty
            $dataCost = [
                ['name' => 'Tort',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Zaproszenia',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
            ];

            Cost::insert($dataCost);

            //Usługi
            $dataCostService = [
                ['name' => 'Sala',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Dekoracja sali',     'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Dekoracje kościoła', 'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Fotograf',               'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
                ['name' => 'Catering',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsService->id],
            ];

            Cost::insert($dataCostService);

            //Sklepy
            $dataCostShops = [
                ['name' => 'Kupić strój dziecku',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
                ['name' => 'Świeca',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCostsShops->id],
            ];

            Cost::insert($dataCostShops);


            $groupTasks = new GroupEvent();
            $groupTasks->name = "Zadania";
            $groupTasks->type = "task";
            $groupTasks->color = "#09A4DB";
            $groupTasks->event_id = $event->id;
            $groupTasks->save();

            $groupTasksReservations = new GroupEvent();
            $groupTasksReservations->name = "Rezerwacje";
            $groupTasksReservations->type = "task";
            $groupTasksReservations->color = "#09A4DB";
            $groupTasksReservations->event_id = $event->id;
            $groupTasksReservations->save();

            $groupTasksDocuments = new GroupEvent();
            $groupTasksDocuments->name = "Dokumenty";
            $groupTasksDocuments->type = "task";
            $groupTasksDocuments->color = "#09A4DB";
            $groupTasksDocuments->event_id = $event->id;
            $groupTasksDocuments->save();

            $dataTasks = [
                ['name' => 'Zarezerwować salę', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zarezerwować termin chrztu w kościele', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wybrać chrzestnych', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wysłać zaproszenia', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić menu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zapasowe pieluchy', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ubranko na zmianę', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
            ];

            Task::insert($dataTasks);

            $dataTasksReservations = [
                ['name' => 'Zarezerwować sale', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować fotografa', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować dekoratora', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować catering', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],
                ['name' => 'Zarezerwować fryzjera', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasksReservations->id],      
            ];


            Task::insert($dataTasksReservations);

            $dataTasksDocuments = [
                ['name' => 'Akt urodzenia dziecka',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasksDocuments->id],
                ['name' => 'Imiona, nazwiska, daty urodzenia i adresy zamieszkania rodziców chrzestnych',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasksDocuments->id],
                ['name' => 'Świadectwo ślubu kościelnego rodziców dziecka (o ile rodzice brali ślub kościelny)',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasksDocuments->id],
                ['name' => 'Potwierdzenie z parafii chrzestnych, że mogą oni zostać rodzicami chrzestnymi.',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasksDocuments->id],
            ];

            Task::insert($dataTasksDocuments);

            $groupGuestsFamily = new GroupEvent();
            $groupGuestsFamily->name = "Goście";
            $groupGuestsFamily->type = "guest";
            $groupGuestsFamily->event_id = $event->id;
            $groupGuestsFamily->save();
    
            $groupService = new GroupEvent();
            $groupService->name = "Usługi";
            $groupService->type = "service";
            $groupService->event_id = $event->id;
            $groupService->save();
            
            $serviceForEvent = ['Fotograf', 'Kamerzysta', 'Catering', 'Sala'];
            $dataService = [];

            foreach($serviceForEvent as $sForEvent)
            {
                $category = Category::where('name', $sForEvent)->get();
                
                if(!is_null($category))
                {
                    foreach($category as $cat)
                    {
                        $dataService[] = ['group_id' => $groupService->id, 'icon_name' => 'brak', 'type' => 'service', 'category_id' => $cat->id];

                        StatisticsCategory::firstOrCreate([
                            "category_id" => $cat->id,
                            "type" => 'Komunia',
                        ])->increment('stats', 1);
                    } 
                } 
            }
        }

        GroupCategory::insert($dataService);


        return $event;
    }

    public function addMainCategoryGroup($request)
    {
        
        $temp = GroupCategory::where('group_id', $request->group)->where('type', 'service')->get();
        $event = Event::with('category')->find(session('event'));
        
        foreach($temp as $category)
        {
            StatisticsCategory::firstOrCreate([
                "category_id" => $category->category_id,
                "type" => $event->category->name,
            ])->decrement('stats', 1);
        }

        GroupCategory::where('group_id', $request->group)->where('type', 'service')->delete();

        if(!is_null($request->mainCategories))
        {

            foreach($request->mainCategories as $categoryId)
            {
                $GroupCategory = new GroupCategory;
                $GroupCategory->group_id = $request->group;
                $GroupCategory->category_id = $categoryId;
                $GroupCategory->icon_name = 'brak';
                $GroupCategory->type = 'service';
                $GroupCategory->save();
                
                StatisticsCategory::firstOrCreate([
                    "category_id" => $categoryId,
                    "type" => $event->category->name,
                ])->increment('stats', 1);

            }
        }
    }
    
    public function getEvent($id)
    {   
        $event = Event::with(['category'])->find($id);
        session(['event' => $event->id]);
        session(['eventName' => $event->name]);

        return $event;
    }

    public function getEventDashboard()
    {   
        return Event::with(['category'])->find(session('event'));
    }

    public function getEventBudget()
    {   
        return Event::where('id', session('event'))->get('budget');
    }

    public function getLikeBusiness()
    {
        return User::with(['businesses.contactable'])->find(Auth::user()->id);
    }

    public function getFinances()
    {
        return GroupEvent::with(['costs'])->where('type','cost')->where('event_id', session('event'))->get();
    }

    public function getFinancesPdf()
    {
        $groupEvent = GroupEvent::with(['costs'])->where('type','cost')->where('event_id', session('event'))->get();
        $event = Event::find(session("event"));
 
        return $data = [
            'groupEvent' => $groupEvent,
            'event' => $event
        ];
    }

    public function getTodayTasks()
    {
        $today = Carbon::now();
        $today = Carbon::createFromFormat('Y-m-d', $today->toDateString()); 
        
        return GroupEvent::with(['costs' => function($q) use($today){
                    $q->whereDate('date_payment', '=', $today->toDateString());
                }, 
                
                'tasks' => function($q) use ($today){
                    $q->whereDate('end_task', '=', $today->toDateString());
                }])
                ->where( function($query){
                    $query->where('type', '=', 'task')
                            ->orWhere('type', '=', 'cost');
                })->where('event_id', session('event'))->get();
    }

    public function getTommorowTasks()
    {
        $tomorrow = Carbon::now();
        $tomorrow->addDay(1);
        $tomorrow = Carbon::createFromFormat('Y-m-d', $tomorrow->toDateString()); 

        return GroupEvent::with(['costs' => function($q) use($tomorrow){
                    $q->whereDate('date_payment', '=', $tomorrow->toDateString());
                }, 
                'tasks' => function($q) use ($tomorrow){
                    $q->whereDate('end_task', '=', $tomorrow->toDateString());
                }])
                ->where( function($query){
                    $query->where('type', '=', 'task')
                            ->orWhere('type', '=', 'cost');
                })->where('event_id', session('event'))->get();
    }

    public function getGuests()
    {
        return GroupEvent::with(['guests'])->where('type','guest')->where('event_id', session('event'))->get();
    }

    public function getGuestsPdf()
    {
        $groupEvent = GroupEvent::with(['guests'])->where('type','guest')->where('event_id', session('event'))->get();
        $event = Event::find(session("event"));

        return $data = [
            'groupEvent' => $groupEvent,
            'event' => $event
        ];
    }

    public function getTasks()
    {
        return GroupEvent::with(['tasks'])->where('type','task')->where('event_id', session('event'))->get();
    }

    public function getTasksPdf()
    {
        $groupEvent = GroupEvent::with(['tasks'])->where('type','task')->where('event_id', session('event'))->get();
        $event = Event::find(session("event"));
 
        return $data = [
            'groupEvent' => $groupEvent,
            'event' => $event
        ];
    }

    public function getServices()
    {
        return GroupEvent::with(['groupCategory' => function($q){
            $q->where('type', '=', 'service');
        }, 
        'groupCategory.category'])->where('event_id', session('event'))->where('type','service')->get();
    }

    public function getServicesDetails($name)
    {
        return GroupEvent::with(['groupCategory.category'])->where('type','service')->where('groupCategory.category.name', $name)->where('event_id', session('event'))->get();
    }

    public function getLikeableServices($idCategory)
    {   
        return User::where('id', Auth::user()->id)->with(["businesses" => function($q) use($idCategory){
            $q->where('businesses.main_category_id', '=', $idCategory);
        }])->get();

    }

    public function addGroup($request)
    {
        $group = new GroupEvent();
        $group->name = $request->group;
        $group->type = $request->type;
        $group->color = $request->color;
        $group->event_id = session('event');
        $group->save();
    }

    public function addGuest($request)
    {
        
        $guest = new Guest();
        $guest->name = $request->name;
        $guest->surname = $request->surname;

        $guest->invitation = ($request->invitation == 'on') ? 1 : 0;
        $guest->confirmation = ($request->confirmation == 'on') ? 1 : 0;
        $guest->accommodation = ($request->accommodation == 'on') ? 1 : 0;
        $guest->transport = ($request->transport == 'on') ? 1 : 0;
        $guest->diet = ($request->diet == 'on') ? 1 : 0;

        $guest->type = $request->type;
        $guest->note = $request->note;
        $guest->group_id = $request->group;
        $guest->save();
    }


    public function addFinanceReservation($serviceName, $business, $eventId)
    {
        $group = GroupEvent::firstOrCreate([
            'type' => 'cost',
            'name' => 'Usługi',
            'event_id' => $eventId,
        ]);


        $finance = new Cost();
        $finance->name = '['.$business.'] Koszty oferty '.$serviceName;
        $finance->note = '';
        $finance->cost = 0;
        $finance->quantity = 1;
        $finance->advance = 0;
        $finance->date_payment = null;
        $finance->status = 0;
        $finance->group_id = $group->id;
        $finance->save();
    }


    public function addFinance($request)
    {
        $finance = new Cost();
        $finance->name = $request->name;
        $finance->note = $request->note;
        $finance->cost = $request->cost;
        $finance->quantity = $request->count;
        $finance->advance = $request->advance;
        $finance->date_payment = $request->date;
        $finance->status = 0;
        $finance->group_id = $request->group;
        $finance->save();
    }
    
    public function addTaskReservation($serviceName, $business, $eventId)
    {
        $group = GroupEvent::firstOrCreate([
            'type' => 'task',
            'name' => 'Usługi',
            'event_id' => $eventId,
        ]);

        $task = new Task();
        $task->name = '['.$business.'] Usalić szczegoły oferty '.$serviceName;
        $task->end_task = null;
        $task->status = 0;
        $task->group_id = $group->id;
        $task->save();
    }

    public function addTask($request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->end_task = $request->date;
        $task->status = 0;
        $task->group_id = $request->group;
        $task->save();
    }

    public function editTask($request)
    {
        Task::where('id', $request->id)->update(['name' => $request->name, 'end_task' => $request->date, 'group_id' => $request->group]);
    }

    public function deleteTask($request)
    {
        $task = Task::find($request->id);
        $task->delete();
    }   

    public function editFinance($request)
    {
        Cost::where('id', $request->id)->update([
            'name' => $request->name, 
            'date_payment' => $request->date,
            'note' => $request->note,
            'cost' => $request->cost,
            'quantity' => $request->count,
            'advance' => $request->advance,
            'status' => 0,
            'group_id' => $request->group
        ]);
    }

    public function deleteFinance($request)
    {
        $cost = Cost::find($request->id);
        $cost->delete();
    }

    public function editGuest($request)
    {
        
        Guest::where('id', $request->id)->update([
            'name' => $request->name, 
            'surname' => $request->surname,
            'invitation' => ($request->invitation == 'on') ? 1 : 0,
            'confirmation' => ($request->confirmation == 'on') ? 1 : 0,
            'accommodation' => ($request->accommodation == 'on') ? 1 : 0,
            'type' => $request->type,
            'transport' => ($request->transport == 'on') ? 1 : 0,
            'diet' => ($request->diet == 'on') ? 1 : 0,
            'note' => $request->note,
            'group_id' => $request->group
        ]);
    }

    public function deleteGuest($request)
    {
        $cost = Guest::find($request->id);
        $cost->delete();
    }

    public function editGroup($request)
    {
        GroupEvent::where('id', $request->id)->update(['name' => $request->name, 'color' => $request->color]);
    }

    public function deleteGroup($request)
    {
        $task = GroupEvent::find($request->id);
        $task->delete();
    }

    public function getNotifications()
    {
        return Notification::where('notification_type', 'App\Models\Event')->where('notification_id', session('event'))->orderBy('created_at','desc')->paginate(8);
    }

    public function setReadNotifications()
    {
        $notifications = Event::with(['notifications'])->find(session('event'));

        foreach($notifications->notifications as $notification)
        {
            Notification::where('id', $notification->id)->update(['status' => 1]);
        }
    }

    public function getEvents()
    {
        return Event::where('user_id', Auth::user()->id)->paginate(10);
    }

    public function deleteEvent()
    {
        Event::where('id', session('event'))->delete();
        session()->forget('event');
    }

}
