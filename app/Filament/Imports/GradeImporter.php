<?php

namespace App\Filament\Imports;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class GradeImporter extends Importer
{
    protected static ?string $model = Grade::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student_id')
                ->requiredMapping()
                ->relationship('student', 'name')
                ->rules(['required']),
            ImportColumn::make('subject_id')
                ->requiredMapping()
                ->relationship('subject', 'name')
                ->rules(['required']),
            ImportColumn::make('grade')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'numeric', 'min:0', 'max:100']),
        ];
    }

    public function resolveRecord(): ?Grade
    {
        return new Grade();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your grade import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}