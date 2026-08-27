<?php

namespace App\Filament\Resources\CrmProjects\Schemas;

use App\Models\CrmProject;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CrmProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('project_value')
                    ->label('Project Value')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('$')
                    ->visible(fn () => auth()->user()?->isAdmin()),
                DatePicker::make('start_date')
                    ->required()
                    ->native(false),
                DatePicker::make('deadline')
                    ->required()
                    ->native(false),
                Select::make('status')
                    ->options(CrmProject::STATUSES)
                    ->required()
                    ->native(false),
                Select::make('teamMembers')
                    ->label('Assigned Team Members')
                    ->relationship(
                        name: 'teamMembers',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->where('status', User::STATUS_ACTIVE)
                    )
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->columnSpanFull()
                    ->visible(fn () => auth()->user()?->isAdmin()),
            ]);
    }
}
