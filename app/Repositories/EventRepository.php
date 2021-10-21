<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use App\Models\Cost;
use App\Models\Group;
use App\Models\Guest;
use App\Models\Task;

use Illuminate\Support\Facades\Auth;

class EventRepository
{
    public function getEventCategories()
    {
        return Category::where('type', 'party')->get();
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

        $groupTasks = new Group();
        $groupTasks->name = "Zadania1";
        $groupTasks->type = "task";
        $groupTasks->event_id = $event->id;
        $groupTasks->save();

        $groupGuestsFamily = new Group();
        $groupGuestsFamily->name = "Rodzina";
        $groupGuestsFamily->type = "guest";
        $groupGuestsFamily->event_id = $event->id;
        $groupGuestsFamily->save();

        $groupGuestsFriends = new Group();
        $groupGuestsFriends->name = "Znajomi";
        $groupGuestsFriends->type = "guest";
        $groupGuestsFriends->event_id = $event->id;
        $groupGuestsFriends->save();

        $groupGuestsCosts = new Group();
        $groupGuestsCosts->name = "Wydatki";
        $groupGuestsCosts->type = "cost";
        $groupGuestsCosts->event_id = $event->id;
        $groupGuestsCosts->save();

        session(['event' => $event->id]);
    
        $dataCost = [
            ['name' => 'Sala weselna',       'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => '2021-12-12', 'status' => 0, 'group_id' => $groupGuestsCosts->id],
            ['name' => 'Dekoracje sali',     'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => '2021-12-12', 'status' => 0, 'group_id' => $groupGuestsCosts->id],
            ['name' => 'Dekoracje kościoła', 'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => '2021-12-12', 'status' => 0, 'group_id' => $groupGuestsCosts->id],
            ['name' => 'Tort',               'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => '2021-12-12', 'status' => 0, 'group_id' => $groupGuestsCosts->id],
            ['name' => 'Katering',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => '2021-12-12', 'status' => 0, 'group_id' => $groupGuestsCosts->id],
            ['name' => 'Alkohol',            'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => '2021-12-12', 'status' => 0, 'group_id' => $groupGuestsCosts->id],
            ['name' => 'Orkiestra',          'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => '2021-12-12', 'status' => 0, 'group_id' => $groupGuestsCosts->id],
            ['name' => 'Suknia',             'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => '2021-12-12', 'status' => 0, 'group_id' => $groupGuestsCosts->id],
            ['name' => 'Fotograf',           'note' => '', 'cost' => 0, 'quantity' => 1, 'advance' => 0, 'date_payment' => '2021-12-12', 'status' => 0, 'group_id' => $groupGuestsCosts->id],

        ];
        Cost::insert($dataCost);

        $dataTasks = [
            ['name' => 'Zamówić mszę',      'end_task' => '2021-12-12' , 'status' => 0 , 'group_id' => $groupTasks->id],
            ['name' => 'Zarezerwować salę', 'end_task' => '2021-12-12' , 'status' => 0 ,'group_id' => $groupTasks->id],
            ['name' => 'Zarezerwować zespół muzyczny', 'end_task' => '2021-12-12' , 'status' => 0 ,'group_id' => $groupTasks->id],
            ['name' => 'Zapisać się na nauki przedmałżeńskie', 'end_task' => '2021-12-12' , 'status' => 0 ,'group_id' => $groupTasks->id],
            ['name' => 'Wybrać świadków', 'end_task' => '2021-12-12' , 'status' => 0 ,'group_id' => $groupTasks->id],
            ['name' => 'Określić budżet', 'end_task' => '2021-12-12' , 'status' => 0 ,'group_id' => $groupTasks->id],
            ['name' => 'Wysłać zaproszenia', 'end_task' => '2021-12-12' , 'status' => 0 ,'group_id' => $groupTasks->id],
            ['name' => 'Zarezerwować fryzjera', 'end_task' => '2021-12-12' , 'status' => 0 ,'group_id' => $groupTasks->id],
            ['name' => 'Ustalić menu', 'end_task' => '2021-12-12' , 'status' => 0 ,'group_id' => $groupTasks->id],
            ['name' => 'Zarezerwować makijażystkę', 'end_task' => '2021-12-12' , 'status' => 0 ,'group_id' => $groupTasks->id],

        ];
        Task::insert($dataTasks);

        return $event;
    }
    
    public function getEvent($id)
    {
        session(['event' => $id]);

        return Event::with(['category'])->find($id);
    }

    public function getLikeBusiness()
    {
        return User::with(['businesses.contactable'])->find(Auth::user()->id);
    }

    public function getFinances()
    {
        return Group::with(['costs'])->where('type','cost')->where('event_id', session('event'))->get();
    }

    public function getGuests()
    {
        return Group::with(['guests'])->where('type','guest')->where('event_id', session('event'))->get();
    }

    public function getTasks()
    {
        return Group::with(['tasks'])->where('type','task')->where('event_id', session('event'))->get();
    }

    public function addGroup($request)
    {
        $group = new Group();
        $group->name = $request->group;
        $group->type = $request->type;
        $group->event_id = session('event');
        $group->save();
    }

    public function addGuest($request)
    {
        $guest = new Guest();
        $guest->name = $request->name;
        $guest->surname = $request->name;
        $guest->invitation = 0;
        $guest->confirmation = 0;
        $guest->accommodation = 0;
        $guest->type = 'Dorosły';
        $guest->transport = 0;
        $guest->note = 'Notatka';
        $guest->group_id = $request->group;
        $guest->save();
    }

    public function addFinance($request)
    {
        $finance = new Cost();
        $finance->name = $request->name;
        $finance->note = 'NOTATKA';
        $finance->cost = 500;
        $finance->quantity = 1;
        $finance->advance = 0;
        $finance->date_payment = '2021-12-12';
        $finance->status = 0;
        $finance->group_id = $request->group;
        $finance->save();
    }

    public function addTask($request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->end_task = '2021-12-12';
        $task->status = 0;
        $task->group_id = $request->group;
        $task->save();
    }
}
