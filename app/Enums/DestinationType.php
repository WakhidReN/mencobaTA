<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
 
enum DestinationType: string implements HasLabel
{
    case AA = 'AA';
    case AO = 'AO';
    case LL = 'LL';
    case AR = 'AR';
    case DO = 'DO';
    case N = 'N';

    public function getLabel(): ?string
    {
        return $this->name;
    
        return match ($this) {
            self::AA => 'AA',
            self::AO => 'AO',
            self::LL => 'LL',
            self::AR => 'AR',
            self::DO => 'DO',
            self::N => 'N'
        };
    }
}