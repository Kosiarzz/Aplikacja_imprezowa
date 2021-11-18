<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation;
use App\Models\GroupEvent;
use App\Models\Business;

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

	public function dateService(Request $request)
    {   
	
        if($request->ajax())
    	{
			$businesses = Business::with([

				'services' => function($q) { //zwracanie sali która ma przynajmniej jedną rezerwacje
					  $q->has('reservations');
				  }, 
	
				  'services.reservations.user.contactable',
	
				])
				  ->has('services.reservations') 
				  ->where('id', session('service'))
				  ->get();
	
			$data = [];

			foreach($businesses as $business)
			{
				foreach($business->services as $service)
				{
					foreach($service->reservations as $reservation)
					{
						if($reservation->status != 'Rezerwacja anulowana' && $reservation->status != 'Rezerwacja odrzucona'){

							$color = '#4caf50';

							if($reservation->status == 'Oczekiwanie na akceptację'){ //'Oczekiwanie na akceptację'
								$color = '#ff4f4f';
							}

							$data[] = [
								'id' => $reservation->id,
								'title' => $reservation->name_business,
								'start' => $reservation->date_from,
								'end' => $reservation->date_to,
								'color' => $color,
							];
						}
					}
				}
			}	  


            return response()->json($data);
    	}
    }

    public function actionService(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Reservation::create([
					'service_id'    =>  session('service'),
					'name_business' =>  $request->title,
    				'status'		=>	'Dodane kalendarz',
    				'date_from'		=>	$request->start,
    				'date_to'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Reservation::find($request->id)->update([
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
