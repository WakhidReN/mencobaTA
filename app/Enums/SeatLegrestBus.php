<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum SeatLegrestBus: string implements HasLabel
{
    case FirstOption = 'Legrest 36';
    
    public function getLabel(): ?string
    {
        return $this->name;
    
        return match ($this) {
            self::FirstOption => 'Legrest 36'
        };
    }
}