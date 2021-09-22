<?php

namespace App\Enums;

class UserRole
{
    const ADMIN = 'admin';
    const MODERATOR = 'moderator';
    const USER = 'user';
    const BUSINESS = 'business';

    const TYPES = [
        self::ADMIN,
        self::MODERATOR,
        self::USER,
        self::BUSINESS
    ];
}