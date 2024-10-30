<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstudianteResource\Pages;
use App\Filament\Resources\EstudianteResource\RelationManagers;
use App\Models\Estudiante;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class EstudianteResource extends Resource
{
    protected static ?string $model = Estudiante::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Estudiantes';

    public static function form(Form $form): Form
    {
        return $form->schema([
            //
            TextInput::make('nombre')->label('Nombre del estudiante')->required(),

            TextInput::make('apellido')->label('apellido del estudiante')->required(),

            TextInput::make('email')
                ->label('Correo del estudiante')
                ->required()
                ->email() 
                ->unique(Estudiante::class, 'email', ignoreRecord: true), // Verificar que el email sea único

            TextInput::make('dni')
                ->label('DNI del estudiante')
                ->required()
                ->unique(Estudiante::class, 'dni'), // Verificar que el DNI sea único

            TextInput::make('telefono')->label('Telefono del estudiante'),

            TextInput::make('numero_legajo')
                ->label('Numero de legajo del estudiante')
                ->required()
                ->integer()
                ->unique(Estudiante::class, 'numero_legajo', ignoreRecord: true), // Verificar que el número de legajo sea único

            Select::make('estado')
                ->label('Estado del estudiante')
                ->options([
                    'activo' => 'Activo',
                    'inactivo' => 'Inactivo',
                ])
                ->required(),

            Select::make('carrera_id')->label('Carrera a la que pertenece el estudiante')->relationship('carreras', 'nombre')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nombre')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('apellido')->label('Apellido'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('dni')->label('DNI')->searchable(),
                TextColumn::make('telefono')->label('Telefono'),
                TextColumn::make('numero_legajo')->label('Nro de legajo')->searchable()->sortable(),
                TextColumn::make('estado')->label('Estado'),
                TextColumn::make('carreras.nombre')->label('Carrera'),
            ])
            ->filters([
                //
                SelectFilter::make('estado')->options([
                    'activo' => 'Activo',
                    'inactivo' => 'Inactivo',
                ]),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
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
            'index' => Pages\ListEstudiantes::route('/'),
            'create' => Pages\CreateEstudiante::route('/create'),
            'edit' => Pages\EditEstudiante::route('/{record}/edit'),
        ];
    }
}
