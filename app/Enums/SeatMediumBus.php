<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum SeatMediumBus: string implements HasLabel
{
    case FirstOption = '31 (2-2)';
    case SecondOption = '33 (2-2)';
    case ThirdOption = '35 (2-2)';
    
    public function getLabel(): ?string
    {
        return $this->name;
    
        return match ($this) {
            self::FirstOption => '31 (2-2)',
            self::SecondOption => '33 (2-2)',
            self::ThirdOption => '35 (2-2)'
        };
    }
}