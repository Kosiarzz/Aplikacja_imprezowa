<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserData;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function getProfileUser($id)
    {
        return User::with(['userData', 'photos'])->find($id);
    }

    public function getLikeableUser($id)
    {
        return User::with(['businesses'])->find($id);
    }

}
