<?php

namespace App\Filament\Resources\GradeResource\Pages;

use App\Filament\Resources\GradeResource;
use App\Models\Classroom;
use App\Models\Subject;
use App\Filament\Exports\GradeExporter;
use App\Filament\Imports\GradeImporter;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\Page;

class ImportExportGrades extends Page
{
    protected static string $resource = GradeResource::class;
    protected static string $view = 'filament.resources.grade-resource.pages.import-export-grades';

    public $classroomId;
    public $subjectId;
    public $classrooms;
    public $subjects;

    public function mount(): void
    {
        $this->classrooms = Classroom::all();
        $this->subjects = Subject::all();
    }

    public function getActions(): array
    {
        $actions = [];

        $actions['export'] = ExportAction::make('export')
            ->label('Export Template Nilai')
            ->icon('heroicon-o-arrow-down-tray')
            ->requiresConfirmation()
            ->modalHeading('Export Template Nilai')
            ->modalDescription('Pilih kelas dan mata pelajaran untuk mengekspor template nilai siswa')
            ->form([
                \Filament\Forms\Components\Select::make('classroomId')
                    ->label('Kelas')
                    ->options($this->classrooms->pluck('name', 'id'))
                    ->required(),
                \Filament\Forms\Components\Select::make('subjectId')
                    ->label('Mata Pelajaran')
                    ->options($this->subjects->pluck('name', 'id'))
                    ->required(),
            ])
            ->exporter(GradeExporter::class) // Pass the class name directly
            ->action(function (array $data, ExportAction $action) {
                $this->classroomId = $data['classroomId'];
                $this->subjectId = $data['subjectId'];

                $students = \App\Models\Student::with('classroom')
                    ->where('classroom_id', $this->classroomId)
                    ->get();

                return (new GradeExporter($students, $this->classroomId, $this->subjectId))
                    ->fileName('template_nilai_kelas_' . $this->classroomId . '_matpel_' . $this->subjectId);
            });

        $actions['import'] = ImportAction::make('import')
            ->label('Import Nilai')
            ->icon('heroicon-o-arrow-up-tray')
            ->requiresConfirmation()
            ->modalHeading('Import Nilai')
            ->modalDescription('Upload file Excel berisi nilai siswa')
            ->importer(GradeImporter::class)
            ->form([
                \Filament\Forms\Components\FileUpload::make('file')
                    ->label('File Excel')
                    ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                    ->required(),
                \Filament\Forms\Components\Hidden::make('subjectId')
                    ->default(fn () => $this->subjectId),
            ]);

        return $actions;
    }
}