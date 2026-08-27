<?php

namespace App\Filament\Resources\CrmTasks\Schemas;

use App\Models\CrmProject;
use App\Models\CrmTask;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CrmTaskForm
{
    public static function configure(Schema $schema): Schema
    {
        $isAdmin = auth()->user()?->isAdmin();

        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->disabled(! $isAdmin),
                Select::make('crm_project_id')
                    ->label('Project')
                    ->options(fn () => CrmProject::query()->orderBy('name')->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->native(false)
                    ->disabled(! $isAdmin),
                Select::make('assigned_user_id')
                    ->label('Assigned Team Member')
                    ->options(fn () => User::query()->where('status', User::STATUS_ACTIVE)->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->native(false)
                    ->disabled(! $isAdmin),
                DatePicker::make('deadline')
                    ->required()
                    ->native(false)
                    ->disabled(! $isAdmin),
                Select::make('priority')
                    ->options(CrmTask::PRIORITIES)
                    ->required()
                    ->native(false)
                    ->disabled(! $isAdmin),
                Select::make('status')
                    ->options(CrmTask::STATUSES)
                    ->required()
                    ->native(false),
            ]);
    }
}
