<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarcaResource\Pages;
use App\Filament\Resources\MarcaResource\RelationManagers;
use App\Models\Marca;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class MarcaResource extends Resource
{
    protected static ?string $model = Marca::class;
    protected static ?string $navigationGroup = 'Catálogo';

    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    TextInput::make('nombre')
                        ->required()
                        ->minLength(3)
                        ->maxLength(32)
                        ->live(onBlur: true)->afterStateUpdated(function (string $operation, ?string $state, Forms\Set $set,)
                        {
                            if($operation === 'edit') { return; }
                            $set ('slug', Str::slug($state));
                        }),
                    TextInput::make('slug')
                        ->required()
                        ->minLength(3)
                        ->maxLength(40)
                        ->unique(ignoreRecord: true),
                ])->columns(1)->columnSpan(2),
                Section::make('Imagen')
                ->schema([
                    FileUpload::make('imagen')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('imagenes/marcas')
                        ->openable()
                        ->downloadable()
                        ->hiddenLabel()
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->searchable(isIndividual: true, isGlobal: false)->sortable(),
                ImageColumn::make('imagen')->label('Logo'),
                TextColumn::make('productos_count')
                    ->counts('productos')
                    ->label('Productos')
                    ->placeholder(0)
                    ->alignEnd()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProductosRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarcas::route('/'),
            'create' => Pages\CreateMarca::route('/create'),
            'edit' => Pages\EditMarca::route('/{record}/edit'),
        ];
    }
}
