<?php

namespace App\Enums;

class NotificationType
{
    const USER = 'App\Models\User';
    const BUSINESS = 'App\Models\Business';
    const EVENT = 'App\Models\Event';

    const TYPES = [
        self::USER,
        self::BUSINESS,
        self::EVENT
    ];
}