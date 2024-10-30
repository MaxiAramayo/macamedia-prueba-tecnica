<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstudianteMateriaResource\Pages;
use App\Filament\Resources\EstudianteMateriaResource\RelationManagers;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\MateriaEstudiante;
use Dotenv\Exception\ValidationException;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
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
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Illuminate\Validation\Validator;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction as TablesExportBulkAction;
use Illuminate\Validation\Rule;
class EstudianteMateriaResource extends Resource
{
    protected static ?string $model = MateriaEstudiante::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Condicion de materias';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Campo de selección de estudiante
            Select::make('estudiante_id')
                ->label('DNI del estudiante')
                ->options(Estudiante::all()->pluck('dni', 'id')->toArray()) // Obtiene los DNI como opciones
                ->searchable() // Permite búsqueda en el select
                ->reactive() // Hace que el campo sea reactivo
                ->afterStateUpdated(function (callable $set, $state) {
                    // Cuando el estudiante cambia, establece el valor de materia_id a null
                    $set('materia_id', null);
                })
                ->required(),

            // Campo de selección de materia
            Select::make('materia_id')
            ->label('Nombre de la materia')
            ->options(function (callable $get) {
                $estudianteId = $get('estudiante_id');
                if ($estudianteId) {
                    $carreraId = Estudiante::find($estudianteId)?->carrera_id;
                    if ($carreraId) {
                        return Materia::where('carrera_id', $carreraId)->pluck('nombre', 'id');
                    }
                }
                return [];
            })
            ->rule(function (callable $get) {
                $estudianteId = $get('estudiante_id');
                $recordId = $get('id');  // Obtenemos el ID del registro en edición, si existe
                return Rule::unique('materia_estudiantes', 'materia_id')
                    ->where('estudiante_id', $estudianteId)
                    ->ignore($recordId);  // Ignoramos el registro actual para evitar conflictos en edición
            }) 
            ->required(), 


            Select::make('estado_de_materia')
                ->label('Estado de la materia')
                ->options([
                    'aprobado' => 'Aprobado',
                    'desaprobado' => 'Desaprobado',
                    'regular' => 'Regular',
                    'libre' => 'libre',
                ])
                ->required(),

            DateTimePicker::make('fecha')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([TextColumn::make('estudiantes.nombre')->label('nombre alumno'), TextColumn::make('estudiantes.apellido')->label('apellido alumno'), TextColumn::make('estudiantes.dni')->label('dni alumno')->searchable(), TextColumn::make('materias.nombre')->label('nombre materia')->searchable(), TextColumn::make('estado_de_materia')->label('estado de la materia'), TextColumn::make('fecha')->label('fecha')])
            ->filters([
                //
                SelectFilter::make('estado_de_materia')->options([
                    'aprobado' => 'Aprobado',
                    'desaprobado' => 'Desaprobado',
                    'regular' => 'Regular',
                    'libre' => 'libre',
                ]),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make(),
            TablesExportBulkAction::make(),
            ])]);
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
            'index' => Pages\ListEstudianteMaterias::route('/'),
            'create' => Pages\CreateEstudianteMateria::route('/create'),
            'edit' => Pages\EditEstudianteMateria::route('/{record}/edit'),
        ];
    }
}
