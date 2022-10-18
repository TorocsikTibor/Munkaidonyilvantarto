<?php

namespace App\Enums;

class Status
{
    const ACCEPTED = 'accepted';
    const DECLINED = 'declined';
    const WAITING_FOR_APPROVAL = 'waiting_for_approval';
    const WITHDRAWN = 'withdrawn';
    const DRAFT = 'draft';

    public static function getValues(): array
    {
        return [
            self::ACCEPTED,
            self::DECLINED,
            self::WAITING_FOR_APPROVAL,
            self::WITHDRAWN,
            self::DRAFT
        ];
    }
}
