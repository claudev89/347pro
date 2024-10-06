<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Imagen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Forms\Components\Hidden;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Forms\Components\Placeholder;


class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;


    protected static ?string $label = 'Categorías';
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
                            ->live(onBlur: true)
                            ->afterStateUpdated( function ( string $operation, ?string $state, Forms\Set $set)
                            {
                                if ( $operation === 'edit') { return ;}
                                $set ('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')->required()->minLength(1)->unique(ignoreRecord: true),

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
                    ->columnSpan(['lg' => fn (?Categoria $record) => $record === null ? 3 : 2]),

                Section::make()
                    ->schema([
                        Placeholder::make('imagen')
                            ->content(function ($record): HtmlString {
                                if($record->imagen)
                                {
                                    return new HtmlString("<img src='". asset('storage/'. $record->imagen->ruta) . "')>");
                                }
                                return new HtmlString('');
                            }),
                        FileUpload::make('imagen')
                            ->image()
                            ->imageEditor()
                            ->getUploadedFileNameForStorageUsing(function ($record) {
                                if ($record->imagen) {
                                    return asset('storage/' . $record->imagen->ruta);
                                }
                                return null;
                            })
                            ->saveUploadedFileUsing(function (TemporaryUploadedFile $file, $record) {
                                if ($record->imagen) {
                                    Storage::disk('public')->delete($record->imagen->ruta);
                                    $record->imagen->delete();
                                }
                                $ruta = $file->store('imagenes/categorias', 'public');
                                $imagen = new Imagen();
                                $imagen->ruta = $ruta;
                                $imagen->imageable()->associate($record);
                                $imagen->save();
                                return $ruta;
                            })
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Categoria $record) => $record === null),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->reorderable('posicion')
        ->columns([
            TextColumn::make('nombre'),
            TextColumn::make('descripcion')
                ->markdown()
                ->weight(FontWeight::Light)
                ->lineClamp(1)
                ->wrap()
                ->placeholder('Sin descripción.'),
            TextColumn::make('productos_count')
                ->counts('productos')
                ->placeholder(0)
                ->alignEnd()
                ->label('Productos'),
            TextColumn::make('subcategorias_count')
                ->counts('subcategorias')
                ->placeholder(0)
                ->alignEnd()
                ->label('Subcategorías'),
            TextInputColumn::make('posicion')
                ->rules(['numeric', 'max:9999'])
                ->label('Posición')
                ->afterStateUpdated(function ($record, $state) {
                    $record->posicion = $state;
                    $record->save();
                }),
        ])
            ->filters([
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
        return parent::getEloquentQuery()->whereNull('categoriaPadre');
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }


}
