<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCategorias extends ListRecords
{
    protected static string $resource = CategoriaResource::class;

    protected $listeners = ['setStatusFilter', 'filter'];

    protected function getHeaderWidgets(): array
    {
        return [
            CategoriaResource\Widgets\CategoriasVacias::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function setStatusFilter(string $filter): void
    {
        $this->tableFilters[$filter]['isActive'] = true;
    }



}
