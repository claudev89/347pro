<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Filament\Resources\CategoriaResource\Widgets\CategoriasVacias;
use App\Models\Categoria;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;


class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;

    protected static ?string $label = 'Categoría';
    protected static ?string $navigationGroup = 'Catálogo';

    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        TextInput::make('nombre')
                            ->required()
                            ->autofocus()
                            ->columnSpan(2)
                            ->minLength(3)
                            ->maxLength(200)
                            ->live(onBlur: true)
                            ->afterStateUpdated( function ( string $operation, ?string $state, Forms\Set $set)
                            {
                                if ( $operation === 'edit') { return ;}
                                $set ('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->minLength(1)
                            ->maxLength(200)
                            ->unique(ignoreRecord: true),

                        Select::make('categoriaPadre')
                            ->label('Categoría padre')
                            ->options(Categoria::all()->pluck('nombre', 'id'))
                            ->placeholder('Inicio'),

                        RichEditor::make('descripcion')
                            ->label('Descripción')
                            ->disableToolbarButtons(['codeBlock', 'attachFiles'])
                            ->maxLength(1024)
                            ->columnSpan(2),
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 2]),

                Section::make()
                    ->schema([
                        FileUpload::make('imagen')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('imagenes/categorias')
                            ->openable()
                            ->downloadable()
                    ])
                    ->columnSpan(['lg' => 1])
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->reorderable('posicion')
        ->columns([
            TextColumn::make('nombre')->sortable()->searchable(),
            TextColumn::make('descripcion')
                ->searchable()
                ->markdown()
                ->weight(FontWeight::Light)
                ->lineClamp(1)
                ->wrap()
                ->placeholder('Sin descripción.'),
            TextColumn::make('productos_count')
                ->counts('productos')
                ->getStateUsing(function ($record) {
                    $subCategoriasIds = $record->subcategorias()->pluck('id');

                    if($subCategoriasIds->isEmpty())
                    {
                        return $record->productos->count();
                    }

                    return Producto::whereIn('categoria_id', $subCategoriasIds->push($record->id))->count();
                })
                ->placeholder(0)
                ->alignEnd()
                ->label('Productos'),
            TextColumn::make('subcategorias_count')
                ->counts('subcategorias')
                ->placeholder(0)
                ->alignEnd()
                ->label('Subcategorías'),
            TextInputColumn::make('posicion')
                ->searchable()
                ->rules(['numeric', 'max:9999'])
                ->label('Posición')
                ->sortable()
                ->afterStateUpdated(function ($record, $state) {
                    $record->posicion = $state;
                    $record->save();
                }),
            ImageColumn::make('imagen'),
        ])
            ->filters([
                Filter::make('con_productos')
                    ->label('Con productos')
                    ->query(fn (Builder $query) => $query->has('productos')),

                Filter::make('sin_productos')
                    ->label('Sin productos')
                    ->query(fn (Builder $query) => $query->doesntHave('productos')),
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
            RelationManagers\CategoriasHijasRelationManager::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereNull('categoria_padre_id');
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return parent::getWidgets([
            CategoriasVacias::class,
        ]);
    }

}
