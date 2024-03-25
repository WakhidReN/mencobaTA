<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum BusPaymentStatus: string implements HasLabel
{
    case Booked_DP = 'Booked - DP';
    case Booked_Non_DP = 'Booked - Non DP';
    case Cancel = 'Dibatalkan';
    
    public function getLabel(): ?string
    {
        return $this->name;
    
        return match ($this) {
            self::Booked_DP => 'Booked - DP',
            self::Booked_Non_DP => 'Booked - Non DP',
            self::Cancel => 'Dibatalkan'
        };
    }
}