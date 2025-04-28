<?php

namespace App\Filament\Resources;

use App\Filament\Imports\StudentImporter;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Classroom;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Forms\Form;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nis')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nisn')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),
                Forms\Components\Select::make('keterangan')
                    ->options([
                        'Lulus' => 'Lulus',
                        'Tidak Lulus' => 'Tidak Lulus',
                    ])
                    ->nullable(),
                Forms\Components\Select::make('classroom_id')
                    ->label('Classroom')
                    ->options(Classroom::all()->pluck('name', 'id'))
                    ->searchable()
                    ->relationship('classroom', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('teacher')
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('nis')
                    ->searchable()
                    ->sortable()
                    ->label('NIS'),
                Tables\Columns\TextColumn::make('nisn')
                    ->searchable()
                    ->sortable()
                    ->label('NISN'),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->searchable()
                    ->sortable()
                    ->label('Tempat Lahir'),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->searchable()
                    ->sortable()
                    ->label('Tanggal Lahir')
                    ->date(),
                Tables\Columns\BadgeColumn::make('keterangan')
                    ->colors([
                        'primary' => 'Lulus',
                        'danger' => 'Tidak Lulus',
                    ]),
                Tables\Columns\TextColumn::make('classroom.name')
                    ->label('Kelas'),
            ])
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->importer(\App\Filament\Imports\StudentImporter::class),
                Tables\Actions\ExportAction::make()
                    ->exporter(\App\Filament\Exports\StudentExporter::class),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('classroom')
                    ->relationship('classroom', 'name')
                    ->label('Classroom')
                    ->options(Classroom::all()->pluck('name', 'id')),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    // ...
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}