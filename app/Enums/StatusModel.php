<?php

namespace App\Enums;

enum StatusModel: string
{
    case Open = 'Open';
    case In_progress = 'In Progress';
    case PENDING = 'Pending';



    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
