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
                ->label('ID Siswa')
                ->requiredMapping()
                ->rules(['required', 'exists:students,id']),
            ImportColumn::make('value')
                ->label('Nilai')
                ->numeric()
                ->rules(['required', 'numeric', 'min:0', 'max:100']),
        ];
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        return 'Import nilai selesai dengan ' . number_format($import->successful_rows) . ' data berhasil diimpor.';
    }

    protected static function beforeCreate(array $data, array $row): array
    {
        $data['subject_id'] = request()->subjectId;
        return $data;
    }
}
