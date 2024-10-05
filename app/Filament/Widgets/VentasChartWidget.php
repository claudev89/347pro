<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class VentasChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Ventas';



    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Ventas',
                    'data' => [3500, 150000, 200000, 30000, 17500]
                ],
            ],
            'labels' => ['Lun', 'Mar', 'Mié', 'Jue', 'Vie']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
