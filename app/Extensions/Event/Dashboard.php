<?php 

namespace App\Extensions\Event;

use App\Repositories\EventRepository;

class Dashboard{

    public function __construct(EventRepository $eRepository)
    {
        $this->eRepository = $eRepository;
    }

    public function getTasksProgress()
    {
        $groups = $this->eRepository->getTasks();

        $numberAllTasks = 0;
        $numberTasksCompleted = 0;
        $percentageTasksCompleted = 0;
        
        foreach($groups as $groupTask)
        {
            foreach($groupTask->tasks as $task)
            {
                
                if($task->status == 1)
                {
                    $numberTasksCompleted++;
                }

                $numberAllTasks++;
            }
        }

        $percentageTasksCompleted = floor(($numberTasksCompleted*100)/$numberAllTasks);

        return [
            "numberAllTasks" => $numberAllTasks,
            "numberTasksCompleted" => $numberTasksCompleted,
            "percentageTasksCompleted" => $percentageTasksCompleted,
        ];;
    }

    public function getGuestsProgress()
    {
        $groups = $this->eRepository->getGuests();

        $numberAllGuests = 0;
        $numberGuestsConfirmed  = 0;
        $percentageGuestsConfirmed = 0;
        
        foreach($groups as $groupGuest)
        {
            foreach($groupGuest->guests as $guest)
            {
                if($guest->confirmation == 1)
                {
                    $numberGuestsConfirmed++;
                }

                $numberAllGuests++;
            }
        }

        $percentageGuestsConfirmed = floor(($numberGuestsConfirmed*100)/$numberAllGuests);

        return [
            "numberAllGuests" => $numberAllGuests,
            "numberGuestsConfirmed" => $numberGuestsConfirmed,
            "percentageGuestsConfirmed" => $percentageGuestsConfirmed,
        ];;
    }

    public function getFinancesProgress()
    {
        $groups = $this->eRepository->getFinances();

        $numberAllFinances = 0;
        $numberFinancesCompleted  = 0;
        $percentageFinancesCompleted = 0;
        
        foreach($groups as $groupFinance)
        {   
            foreach($groupFinance->costs as $finance)
            {
                if($finance->status == 1)
                {
                    $numberFinancesCompleted++;
                }

                $numberAllFinances++;
            }
        }

        $percentageFinancesCompleted = floor(($numberFinancesCompleted*100)/$numberAllFinances);

        return [
            "numberAllFinances" => $numberAllFinances,
            "numberFinancesCompleted" => $numberFinancesCompleted,
            "percentageFinancesCompleted" => $percentageFinancesCompleted,
        ];;
    }
}