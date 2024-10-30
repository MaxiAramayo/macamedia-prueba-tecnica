<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MateriasResource\Pages;
use App\Filament\Resources\MateriasResource\RelationManagers;
use App\Models\Materia;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MateriasResource extends Resource
{
    protected static ?string $model = Materia::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Materias';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')->label('Nombre de la materia')->required()->unique(Materia::class, 'nombre', ignoreRecord: true),

                Select::make('duracion')
                ->label('Duracion de la materia')
                ->options([
                    'cuatrimetral' => 'Cuatrimestral',
                    'anual' => 'Anual',
                ])->required(),

                Select::make('carrera_id')->label('Carrera a la que pertenece')->relationship('carreras', 'nombre')->required(),
                
                TextInput::make('horas')->numeric()->label('Horas de cursado')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->label('Nombre'),
                TextColumn::make('duracion')->label('Duracion'),
                TextColumn::make('horas')->label('Horas de cursado'),
                TextColumn::make('carreras.nombre')->label('Carrera a la que pertenece'),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMaterias::route('/'),
            'create' => Pages\CreateMaterias::route('/create'),
            'edit' => Pages\EditMaterias::route('/{record}/edit'),
        ];
    }
}
