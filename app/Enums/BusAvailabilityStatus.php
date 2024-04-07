<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum BusAvailabilityStatus: string implements HasLabel
{
    case Tersedia = 'Available';
    case Dipesan = 'Booked';
    case Dibatalkan = 'Cancel';
    
    public function getLabel(): ?string
    {    
        return match ($this) {
            self::Tersedia => 'Available',
            self::Dipesan => 'Booked',
            self::Dibatalkan => 'Cancel'
        };
    }
}