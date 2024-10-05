<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Stock extends Page
{
    protected static ?string $navigationGroup = 'Catálogo';

    protected static ?int $navigationSort = 40;

    protected static string $view = 'filament.pages.stock';
}
