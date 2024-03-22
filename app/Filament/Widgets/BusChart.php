<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Bus;
use Filament\Widgets\ChartWidget;

class BusChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Armada Per Bulan';
    protected static ?int $sort = 2; 

    protected function getData(): array
    {
        $data = $this->getBusPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Bulan',
                    'data' => $data['busPerMonth'],
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getBusPerMonth(): array {
        $now = Carbon::now();
        $busPerMonth = [];

        $months = collect(range(1, 12))->map(
            function ($month) use ($now, &$busPerMonth) {
                $startOfMonth = $now->copy()->month($month)->startOfMonth();
                $endOfMonth = $now->copy()->month($month)->endOfMonth();

                $count = Bus::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
                $busPerMonth[] = $count;

                return $startOfMonth->format('M');
            }
        )->toArray();

        return [
            'busPerMonth' => $busPerMonth,
            'months' => $months,
        ];
    }
}
