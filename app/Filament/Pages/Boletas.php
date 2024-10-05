<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Boletas extends Page
{
    protected static ?string $navigationGroup = 'Pedidos';

    protected static ?int $navigationSort = 20;

    protected static string $view = 'filament.pages.boletas';
}
