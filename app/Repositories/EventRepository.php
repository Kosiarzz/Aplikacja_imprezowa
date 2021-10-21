<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Event;

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

        return $event;
        
    }
    
    public function getEvent($id)
    {
        return Event::with(['category'])->find($id);
    }
   
}
