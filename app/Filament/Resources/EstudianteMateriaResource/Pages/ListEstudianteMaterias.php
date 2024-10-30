<?php

namespace App\Filament\Resources\EstudianteMateriaResource\Pages;

use App\Filament\Resources\EstudianteMateriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstudianteMaterias extends ListRecords
{
    protected static string $resource = EstudianteMateriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
