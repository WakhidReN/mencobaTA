<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum SeatLegrestBus: string implements HasLabel
{
    case Seat_1 = 'Legrest 36';
    
    public function getLabel(): ?string
    {
        return match ($this) {
            self::Seat_1 => 'Legrest 36'
        };
    }
}