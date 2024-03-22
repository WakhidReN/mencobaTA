<?php

namespace App\Filament\Widgets;

use App\Models\Bus;
use App\Models\BusAvailability;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BusStats extends BaseWidget
{
    protected static ?int $sort = 1; 

    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Mitra Armada', Bus::distinct('name')->count()),
            Stat::make('Jumlah Ketersediaan Bus', BusAvailability::count()),
        ];
    }
}
