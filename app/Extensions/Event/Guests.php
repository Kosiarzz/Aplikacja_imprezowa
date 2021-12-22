<?php 

namespace App\Extensions\Event;

use App\Repositories\EventRepository;

class Guests{

    public function __construct(EventRepository $eRepository)
    {
        $this->eRepository = $eRepository;
    }

    public function getGuestsDetails()
    {
        $guests = $this->eRepository->getGuests();

        $invitation = 0;
        $confirmation = 0;
        $nonConfirmation = 0;
        $accommodation = 0;
        $transport = 0;
        $diet = 0;
        $adults = 0;
        $children = 0;

        foreach($guests as $groups)
        {
            foreach($groups->guests as $guest)
            {
                if($guest->invitation)
                {
                    $invitation++;
                }
                if($guest->confirmation)
                {
                    $confirmation++;
                }
                else
                {
                    $nonConfirmation++;
                }
                if($guest->accommodation)
                {
                    $accommodation++;
                }
                if($guest->diet)
                {
                    $diet++;
                }
                if($guest->transport)
                {
                    $transport++;
                }
                if($guest->type == 'Dorosły')
                {
                    $adults++;
                }
                if($guest->type == 'Dziecko')
                {
                    $children++;
                }

            }
        }

        return [
            'invitation' => $invitation,
            'confirmation' => $confirmation,
            'nonConfirmation' => $nonConfirmation,
            'accommodation' => $accommodation,
            'diet' => $diet,
            'transport' => $transport,
            'adults' => $adults,
            'children' => $children
        ];
    }
}