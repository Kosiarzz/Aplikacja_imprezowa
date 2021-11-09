<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\GroupEvent;

class FullCalenderController extends Controller
{
	
    public function dateEvent(Request $request)
    {   
        if($request->ajax())
    	{
    		$groupsTask = GroupEvent::with(['tasks'])->where('event_id', session('event'))->where('type','task')->get();
            $groupsCost = GroupEvent::with(['costs'])->where('event_id', session('event'))->where('type','cost')->get();


			$data = [];

			foreach($groupsTask as $group)
			{
                foreach($group->tasks as $task)
			    {
                    $data[] = [
                        'id' => $task->id,
                        'title' => $task->name,
                        'start' => $task->end_task,
                        'end' => date('Y-m-d', strtotime($task->end_task . ' +1 day')),
                        'color' => $group->color,
                    ];
                }
			}

            foreach($groupsCost as $group)
			{
                foreach($group->costs as $cost)
			    {
                    $data[] = [
                        'id' => $cost->id,
                        'title' => $cost->name,
                        'start' => $cost->date_payment,
                        'end' => date('Y-m-d', strtotime($cost->date_payment . ' +1 day')),
                        'color' => $group->color,
                    ];
                }
			}

            return response()->json($data);
    	}
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Reservation::create([
    				'status'		=>	$request->title,
    				'date_from'		=>	$request->start,
    				'date_to'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Reservation::find($request->id)->update([
    				'status'		=>	$request->title,
    				'date_from'		=>	$request->start,
    				'date_to'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Reservation::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
}
