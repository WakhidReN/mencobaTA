<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\BusAvailability;
use Filament\Widgets\ChartWidget;

class BusAvailabilityChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Ketersediaan Bus Per Bulan';
    protected static ?int $sort = 2; 

    protected function getData(): array
    {
        $data = $this->getBusAvailabilityPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Bulan',
                    'data' => $data['busAvailabilityPerMonth'],
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getBusAvailabilityPerMonth(): array {
        $now = Carbon::now();
        $busAvailabilityPerMonth = [];

        $months = collect(range(1, 12))->map(
            function ($month) use ($now, &$busAvailabilityPerMonth) {
                $startOfMonth = $now->copy()->month($month)->startOfMonth();
                $endOfMonth = $now->copy()->month($month)->endOfMonth();

                $count = BusAvailability::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
                $busAvailabilityPerMonth[] = $count;

                return $startOfMonth->format('M');
            }
        )->toArray();

        return [
            'busAvailabilityPerMonth' => $busAvailabilityPerMonth,
            'months' => $months,
        ];
    }
}
