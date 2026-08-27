<?php

namespace App\Filament\Resources\CrmUsers\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CrmUsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('name')
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('designation')->label('Designation')->placeholder('—'),
                TextColumn::make('role')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === User::ROLE_ADMIN ? 'Admin' : 'Team Member'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state) => $state === User::STATUS_ACTIVE ? 'success' : 'gray'),
                TextColumn::make('crm_projects_count')->counts('crmProjects')->label('Projects'),
                TextColumn::make('assigned_tasks_count')->counts('assignedTasks')->label('Tasks'),
            ])
            ->filters([
                SelectFilter::make('role')->options([
                    User::ROLE_ADMIN => 'Admin',
                    User::ROLE_TEAM_MEMBER => 'Team Member',
                ]),
                SelectFilter::make('status')->options([
                    User::STATUS_ACTIVE => 'Active',
                    User::STATUS_INACTIVE => 'Inactive',
                ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ]);
    }
}
