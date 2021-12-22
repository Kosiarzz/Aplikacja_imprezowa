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

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EventRepository
{
    public function getEventCategories()
    {
        return Group::with(['groupCategory.category'])->where('type', 'partyCategory')->where('name', 'partyCategory')->get();
    }

    public function getServiceCategories()
    {
        return Group::with(['groupCategory.category'])->where('type','mainCategory')->where('name', 'mainCategory')->get();
    }

    public function getStatisticCategories($categoryName)
    {
        return StatisticsCategory::where('type', $categoryName)->with(['category'])->orderBy('stats','desc')->get();
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

    public function createEvent($request)
    {

        $event = new Event();
        $event->name = $request->name;
        $event->budget = $request->budget;
        $event->date_event = $request->date;
        $event->category_id = $request->party;
        $event->user_id = Auth::user()->id;
        $event->save();

        $groupTasks = new GroupEvent();
        $groupTasks->name = "Zadania1";
        $groupTasks->type = "task";
        $groupTasks->color = "#09A4DB";
        $groupTasks->event_id = $event->id;
        $groupTasks->save();

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

        $groupCosts = new GroupEvent();
        $groupCosts->name = "Wydatki";
        $groupCosts->type = "cost";
        $groupCosts->color = "#F64C32";
        $groupCosts->event_id = $event->id;
        $groupCosts->save();

        $groupService = new GroupEvent();
        $groupService->name = "Usługi";
        $groupService->type = "service";
        $groupService->event_id = $event->id;
        $groupService->save();


        session(['event' => $event->id]);
        if($request->party == 1) //wesele
        {
            $dataCost = [
                ['name' => 'Sala weselna',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Dekoracje sali',     'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Dekoracje kościoła', 'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Tort',               'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Katering',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Alkohol',            'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Orkiestra',          'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Suknia',             'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Fotograf',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],

            ];

            $dataTasks = [
                ['name' => 'Zamówić mszę',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasks->id],
                ['name' => 'Zarezerwować salę', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zarezerwować zespół muzyczny', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zapisać się na nauki przedmałżeńskie', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wybrać świadków', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Określić budżet', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wysłać zaproszenia', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zarezerwować fryzjera', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić menu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zarezerwować makijażystkę', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],

            ];

            $serviceForEvent = ['Fotograf', 'Catering', 'Zespół muzyczny', 'Auto do wynajęcia', 'Salon sukien', 'Sala'];
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
            $dataCost = [
                ['name' => 'Opłacić sale',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Dekorator sali',     'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Katering',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Tort',               'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Alkohol',            'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'DJ',                 'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Fryzjer',            'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Fotograf',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],

            ];

            $dataTasks = [
                ['name' => 'Zarezerwować sale',                'end_task' => null, 'status' => 0, 'group_id' => $groupTasks->id],
                ['name' => 'Zamówić tort',                     'end_task' => null, 'status' => 0, 'group_id' => $groupTasks->id],
                ['name' => 'Kupić alkohol',                    'end_task' => null, 'status' => 0, 'group_id' => $groupTasks->id],
                ['name' => 'Zarezerwować DJ',                  'end_task' => null, 'status' => 0, 'group_id' => $groupTasks->id],
                ['name' => 'Umówić się na wizytę do fryzjera', 'end_task' => null, 'status' => 0, 'group_id' => $groupTasks->id],
                ['name' => 'Zobaczyć salę',                    'end_task' => null, 'status' => 0, 'group_id' => $groupTasks->id],
                ['name' => 'Określić liczbę gości',            'end_task' => null, 'status' => 0, 'group_id' => $groupTasks->id],
                ['name' => 'Wybrać muzykę',                    'end_task' => null, 'status' => 0, 'group_id' => $groupTasks->id],
                ['name' => 'Wysłać zaprosznia',                'end_task' => null, 'status' => 0, 'group_id' => $groupTasks->id],
 
            ];

            $serviceForEvent = ['Fotograf', 'Catering', 'DJ', 'Sala'];
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

        if($request->party == 3) //chrzciny
        {
            $groupGuestsFriends = new GroupEvent();
            $groupGuestsFriends->name = "Rodzice chrzestni";
            $groupGuestsFriends->type = "guest";
            $groupGuestsFriends->event_id = $event->id;
            $groupGuestsFriends->save();

            $dataCost = [
                ['name' => 'Sala',               'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Dekorator',          'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Dekoracje kościoła', 'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Fotogram',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Kamerzysta',         'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
                ['name' => 'Zaproszenia',        'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => null, 'status' => 0, 'group_id' => $groupCosts->id],
            ];

            $dataTasks = [
                ['name' => 'Zamówić mszę',      'end_task' => null , 'status' => 0 , 'group_id' => $groupTasks->id],
                ['name' => 'Zarezerwować salę', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Wybrać chrzestnych', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zaprosić gości', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zarezerować fryzjera', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Zarezerwować makijażystkę', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Kupić ubranko dziecku', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić menu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Ustalić ile gości potrzebuje noclegu', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],
                ['name' => 'Odebrać tort', 'end_task' => null , 'status' => 0 ,'group_id' => $groupTasks->id],

            ];

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

        
        Cost::insert($dataCost);
        Task::insert($dataTasks);
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


    public function addFinanceReservation($serviceName, $eventId)
    {
        $group = GroupEvent::firstOrCreate([
            'type' => 'cost',
            'name' => 'Usługi',
            'event_id' => $eventId,
        ]);


        $finance = new Cost();
        $finance->name = 'Koszty oferty '.$serviceName;
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
    
    public function addTaskReservation($serviceName, $eventId)
    {
        $group = GroupEvent::firstOrCreate([
            'type' => 'task',
            'name' => 'Usługi',
            'event_id' => $eventId,
        ]);

        $task = new Task();
        $task->name = 'Usalić szczegoły oferty '.$serviceName;
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
