<?php

namespace App\Filament\Resources\MateriasResource\Pages;

use App\Filament\Resources\MateriasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterias extends ListRecords
{
    protected static string $resource = MateriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
