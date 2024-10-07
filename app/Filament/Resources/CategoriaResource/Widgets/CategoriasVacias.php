<?php

namespace App\Filament\Resources\CategoriaResource\Widgets;

use App\Models\Categoria;
use App\Models\Producto;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CategoriasVacias extends BaseWidget
{

    protected function getStats(): array
    {
        return [
            Stat::make('Categorías vacías', Categoria::whereDoesntHave('productos')->count())
                ->description(' ')
                ->descriptionIcon('heroicon-m-bookmark', position: IconPosition::Before)
                ->color('primary')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'sin_productos' })",
            ]),

            Stat::make('Categoría más vista', Categoria::categoriaMasVista())
                    ->description(' ')
                    ->descriptionIcon('heroicon-m-arrow-trending-up', position: IconPosition::Before)
                    ->color('primary'),

            Stat::make('Promedio de productos por categoría', Categoria::productosPorCategoria())
                ->description(' ')
                ->descriptionIcon('heroicon-m-plus-circle', position: IconPosition::Before)
                ->color('primary'),
        ];
    }
}
