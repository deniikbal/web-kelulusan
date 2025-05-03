<?php

namespace App\Filament\Resources\GradeResource\Pages;

use App\Filament\Resources\GradeResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\CreateAction;

class ListGrades extends ListRecords
{
    protected static string $resource = GradeResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}