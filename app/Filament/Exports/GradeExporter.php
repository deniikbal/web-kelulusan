<?php

namespace App\Filament\Exports;

use App\Models\Student;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class GradeExporter extends Exporter
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nis')
                ->label('NIS'),
            ExportColumn::make('name')
                ->label('Nama Siswa'),
            ExportColumn::make('classroom.name')
                ->label('Kelas'),
            ExportColumn::make('nilai')
                ->label('Nilai')
                ->state(function (Student $record): string {
                    return '';
                }),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        return 'Template nilai berhasil diekspor dan siap diisi.';
    }
}
