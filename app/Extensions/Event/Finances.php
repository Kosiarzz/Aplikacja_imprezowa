<?php 

namespace App\Extensions\Event;

use App\Repositories\EventRepository;

class Finances{

    public function __construct(EventRepository $eRepository)
    {
        $this->eRepository = $eRepository;
    }

    public function getBudgetDetails()
    {
        $budget = $this->eRepository->getEventBudget();
        $finances = $this->eRepository->getFinances();

        $sumExpenses = 0;
        $advancePayments = 0;

        foreach($finances as $groups)
        {
            foreach($groups->costs as $cost)
            {
                $sumExpenses+=$cost->cost*$cost->quantity;
                $advancePayments+=$cost->advance;
            }
        }

        return [
            'budget' => $budget[0]->budget,
            'sumExpenses' => $sumExpenses,
            'advancePayments' => $advancePayments
        ];
    }
}