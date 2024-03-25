<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum BusAvailabilityStatus: string implements HasLabel
{
    case Available = 'Tersedia';
    case Booked = 'Dipesan';
    case Cancel = 'Dibatalkan';
    
    public function getLabel(): ?string
    {
        return $this->name;
    
        return match ($this) {
            self::Available => 'Tersedia',
            self::Booked => 'Dipesan',
            self::Cancel => 'Dibatalkan'
        };
    }
}