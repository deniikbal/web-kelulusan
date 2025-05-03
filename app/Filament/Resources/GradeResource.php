<?php

namespace App\Filament\Resources;

use App\Filament\Imports\GradeImporter;
use App\Filament\Resources\GradeResource\Pages;
use App\Filament\Resources\GradeResource\RelationManagers;
use App\Models\Grade;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('student_id')
                    ->relationship('student', 'name')
                    ->required(),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),
                TextInput::make('grade')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')->label('Nama Siwa'),
                Tables\Columns\TextColumn::make('student.classroom.name')->label('Kelas'), // Updated line
                Tables\Columns\TextColumn::make('subject.name')->label('Matpel'),
                Tables\Columns\TextColumn::make('grade')->label('Nilai'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->importer(GradeImporter::class),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }
}