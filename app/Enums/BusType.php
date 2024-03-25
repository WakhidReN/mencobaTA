<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum BusType: string implements HasLabel
{
    case Big = 'Big Bus';
    case Medium = 'Medium';
    case Legrest = 'Legrest';
    
    public function getLabel(): ?string
    {
        return $this->name;
    
        return match ($this) {
            self::Big => 'Big Bus',
            self::Medium => 'Medium',
            self::Legrest => 'Legrest'
        };
    }
}