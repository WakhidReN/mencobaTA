<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum SeatBigBus: string implements HasLabel
{
    case Seat_1 = '50 (2-2)';
    case Seat_2 = '52 (2-2)';
    case Seat_3 = '60 (2-3)';
    case Seat_4 = '61 (2-3)';
    
    public function getLabel(): ?string
    {    
        return match ($this) {
            self::Seat_1 => '50 (2-2)',
            self::Seat_2 => '52 (2-2)',
            self::Seat_3 => '60 (2-3)',
            self::Seat_4 => '61 (2-3)'
        };
    }
}