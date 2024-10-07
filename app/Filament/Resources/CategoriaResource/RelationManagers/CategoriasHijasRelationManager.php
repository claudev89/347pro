<?php

namespace App\Filament\Resources\CategoriaResource\RelationManagers;

use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Illuminate\Support\Str;

class CategoriasHijasRelationManager extends RelationManager
{
    protected static string $relationship = 'subcategorias';
    protected static ?string $label = "Subcategoría";


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
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

                        FileUpload::make('imagen')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('imagenes/categorias')
                            ->openable()
                            ->downloadable(),

                        RichEditor::make('descripcion')
                            ->label('Descripción')
                            ->disableToolbarButtons(['codeBlock', 'attachFiles'])
                            ->maxLength(1024)
                            ->columnSpan(2),
                    ])
                    ->columns(2)
            ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),
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
                ImageColumn::make('imagen'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
