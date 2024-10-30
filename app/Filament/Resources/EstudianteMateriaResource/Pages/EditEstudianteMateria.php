<?php

namespace App\Filament\Resources\EstudianteMateriaResource\Pages;

use App\Filament\Resources\EstudianteMateriaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstudianteMateria extends EditRecord
{
    protected static string $resource = EstudianteMateriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
