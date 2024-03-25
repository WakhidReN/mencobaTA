<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum SeatBigBus: string implements HasLabel
{
    case FirstOption = '50 (2-2)';
    case SecondOption = '52 (2-2)';
    case ThirdOption = '60 (2-3)';
    case ThirdOption = '61 (2-3)';
    case FourthOption = '61 (2-3)';
    
    public function getLabel(): ?string
    {
        return $this->name;
    
        return match ($this) {
            self::FirstOption => '50 (2-2)',
            self::SecondOption => '52 (2-2)',
            self::ThirdOption => '60 (2-3)',
            self::FourthOption => '61 (2-3)'
        };
    }
}