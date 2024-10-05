<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Categoria;
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
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;


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
                    Section::make()
                        ->schema([
                                    Group::make([
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
                                            })
                                            ,
                                        TextInput::make('slug')->required()->minLength(1)->unique(ignoreRecord: true),
                                    ])->columns(3),

                            Group::make([
                                Select::make('categoriaPadre')
                                    ->label('Categoría padre')
                                    ->options(Categoria::all()->pluck('nombre', 'id')),
                            ])->columns(2),

                            Group::make([
                                RichEditor::make('descripcion')->label('Descripción')
                                    ->disableToolbarButtons(['codeBlock', 'attachFiles'])->columnSpan(2)->maxLength(1024),
                                FileUpload::make('imagen')
                                    ->image()
                                    ->imageEditor(),
                            ])->columns(3),
                        ]),
            ])->columns(3);
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
                    ->wrap(),
                TextColumn::make('Productos')->counts('productos'),
                TextInputColumn::make('posicion')
                    ->rules(['numeric', 'max:9999'])
                    ->label('Posición')
                    ->afterStateUpdated(function ($record, $state) {
                        $record->posicion = $state;
                        $record->save();
                    }),
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
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }

}
