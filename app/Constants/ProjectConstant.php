<?php

namespace App\Constants;

class ProjectConstant
{
    const STATUS_PLANNED = 'planned';
    const STATUS_ACTIVE = 'active';
    const STATUS_COMPLETED = 'completed';
    const STATUS_ON_HOLD = 'on_hold';

    const STATUSES = [
        self::STATUS_PLANNED,
        self::STATUS_ACTIVE,
        self::STATUS_COMPLETED,
        self::STATUS_ON_HOLD,
    ];
}
