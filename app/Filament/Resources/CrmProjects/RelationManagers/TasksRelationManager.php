<?php

namespace App\Filament\Resources\CrmProjects\RelationManagers;

use App\Models\CrmTask;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->maxLength(255)->columnSpanFull(),
                Select::make('assigned_user_id')
                    ->label('Assigned To')
                    ->options(fn () => User::query()->where('status', User::STATUS_ACTIVE)->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->native(false),
                DatePicker::make('deadline')->required()->native(false),
                Select::make('priority')->options(CrmTask::PRIORITIES)->required()->native(false)->default('medium'),
                Select::make('status')->options(CrmTask::STATUSES)->required()->native(false)->default('pending'),
            ]);
    }

    public function table(Table $table): Table
    {
        $isAdmin = auth()->user()?->isAdmin();

        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('assignee.name')->label('Assigned To'),
                TextColumn::make('priority')->badge()->formatStateUsing(fn ($state) => CrmTask::PRIORITIES[$state] ?? $state),
                TextColumn::make('deadline')->date(),
                TextColumn::make('status')->badge()->formatStateUsing(fn ($state) => CrmTask::STATUSES[$state] ?? $state),
            ])
            ->headerActions([
                CreateAction::make()->visible($isAdmin),
            ])
            ->recordActions([
                EditAction::make()->visible(fn () => auth()->user()?->isAdmin() || auth()->user()?->isTeamMember()),
                DeleteAction::make()->visible($isAdmin),
            ]);
    }
}
