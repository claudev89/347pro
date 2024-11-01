<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Producto;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextInputColumn;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationGroup = 'Catálogo';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    TextInput::make('nombre')
                        ->maxLength(150)
                        ->minLength(3)
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, ?string $state, Forms\Set $set) {
                            if($operation === 'edit') { return; }
                            $set ('slug', Str::slug($state));
                        })
                        ->columnSpan(1),

                    TextInput::make('precio')
                        ->required()
                        ->columnSpan(1)
                        ->numeric()
                        ->prefixIcon('heroicon-m-currency-dollar'),

                    RichEditor::make('descripcion_corta')
                        ->label('Resumen')
                        ->disableToolbarButtons(['codeBlock'])
                        ->required()
                        ->maxLength(1000)
                        ->columnSpan(2)
                        ->hint(fn ($state, $component) => strlen($state) . '/' . $component->getMaxLength())
                        ->live(debounce: '300ms'),

                    RichEditor::make('descripcion_larga')
                        ->label('Descripción')
                        ->disableToolbarButtons(['codeBlock'])
                        ->columnSpan(2),

                    Select::make('categoria_id')
                        ->placeholder('Inicio')
                        ->label('Categoría')
                        ->searchable()
                        ->options(function () {
                            $categoriasOrdenadas = [];
                            $categorias = Categoria::all();
                            $subcategorias = [];

                            foreach ($categorias as $categoria)
                            {
                                $subcategoriasArray = [];
                                $subcategoriasArray[$categoria->id] = $categoria->nombre;
                                $subcategorias = $categoria->subcategorias;
                                foreach ($subcategorias as $subcategoria)
                                {
                                    $subcategoriasArray[$subcategoria->id] = $subcategoria->nombre;
                                }
                                if(is_null($categoria->categoriaPadre))
                                {
                                    $categoriasOrdenadas[$categoria->nombre] = $subcategoriasArray;
                                }

                            }

                            return $categoriasOrdenadas;

                        }),

                    Select::make('marca')->relationship('marca', 'nombre')->required()

                ])->columns(2)->columnSpan(2),

                Section::make('Datos adicionales')
                ->schema([
                    TextInput::make('slug')->required()->minLength(1)->maxLength(180),

                    TextInput::make('cantidad')
                        ->label('Stock')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(1000)
                        ->required(),

                    FileUpload::make('imagenes')
                        ->label('Imágenes')
                        ->helperText('La primera imagen es la principal (se pueden arrastrar para reordenar).')
                        ->acceptedFileTypes(['image/jpeg', 'video/mp4', 'image/png', 'image/svg+xml', 'image/webp'])
                        ->multiple()
                        ->reorderable()
                        ->directory('imagenes/productos')
                        ->disk('public')
                        ->openable()
                        ->downloadable()
                        ->panelLayout('grid')
                        ->appendFiles()
                        ->maxSize(51200)
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordClasses(fn (Producto $record) => match (true) {
                $record->cantidad >0 && $record->cantidad <= 3 => 'bg-warning-200',
                $record->cantidad == 0 => 'bg-danger-200',
                default => null,
            })
            ->columns([
                ImageColumn::make('imagenes')
                    ->label('Imagen')
                    ->limit(1)
                    ->limitedRemainingText()
                    ->getStateUsing(function ($record) {
                        foreach ($record->imagenes as $media) {
                            $extension = pathinfo($media, PATHINFO_EXTENSION);
                            if (!in_array(strtolower($extension), ['mp4', 'mpeg4'])) {
                                return $media; // Retorna la primera imagen válida
                            }
                        }
                        return null;
                }),
                TextColumn::make('nombre')->sortable()->searchable(isIndividual: true, isGlobal: false),
                TextColumn::make('categoria.nombre')->sortable()->searchable(isIndividual: true, isGlobal: false),
                TextColumn::make('precio')->sortable()->money('CLP', 1, true),
                TextInputColumn::make('cantidad')
                    ->label('Stock')
                    ->alignEnd()
                    ->sortable()
                    ->rules(['required', 'numeric', 'min:0'])
                    ->type('number')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }

}
