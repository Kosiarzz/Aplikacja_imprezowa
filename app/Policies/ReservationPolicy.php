<?php

namespace App\Policies;

use App\Models\{User,Reservation};
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function reservation(User $user, Reservation $reservation)
    {

        if($user->isBusiness())
        {
            return $user->id === $reservation->service->business->user_id;
        }
        
        return $user->id === $reservation->user_id;
    }
}
