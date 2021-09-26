<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserData;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function getProfileUser($id)
    {
        return User::with(['userData'])->find($id);
    }

}
