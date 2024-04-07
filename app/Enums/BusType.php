<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum BusType: string implements HasLabel
{
    case BigBus = 'Big Bus';
    case Medium = 'Medium';
    case Legrest = 'Legrest';
    
    public function getLabel(): ?string
    {    
        return match ($this) {
            self::BigBus => 'Big Bus',
            self::Medium => 'Medium',
            self::Legrest => 'Legrest'
        };
    }
}