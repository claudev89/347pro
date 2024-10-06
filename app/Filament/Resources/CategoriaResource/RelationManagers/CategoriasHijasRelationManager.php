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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
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
//                            RichEditor::make('descripcion')->label('Descripción')
//                                ->disableToolbarButtons(['codeBlock', 'attachFiles'])->columnSpan(2)->maxLength(1024),
                            FileUpload::make('descripcion')
                                ->image()
                                ->imageEditor(),
                        ])->columns(3),
                    ]),
            ])->columns(3);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
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
