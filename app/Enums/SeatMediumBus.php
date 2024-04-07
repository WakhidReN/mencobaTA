<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum SeatMediumBus: string implements HasLabel
{
    case Seat_1 = '31 (2-2)';
    case Seat_2 = '33 (2-2)';
    case Seat_3 = '35 (2-2)';
    
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Seat_1 => '31 (2-2)',
            self::Seat_2 => '33 (2-2)',
            self::Seat_3 => '35 (2-2)'
        };
    }
}