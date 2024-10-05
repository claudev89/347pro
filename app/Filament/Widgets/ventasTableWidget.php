<?php

namespace App\Filament\Widgets;

use App\Models\Boleta;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class ventasTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Productos y Ventas';

    public function table(Table $table): Table
    {
        return $table
            ->query(Boleta::query())
            ->columns([
                TextColumn::make('created_at'),
            ]);
    }
}
