<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getProfileUser($id);
    public function getLikeableUser($id);
}
