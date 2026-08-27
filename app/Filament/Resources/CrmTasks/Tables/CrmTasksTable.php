<?php

namespace App\Filament\Resources\CrmTasks\Tables;

use App\Models\CrmTask;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CrmTasksTable
{
    public static function configure(Table $table): Table
    {
        $isAdmin = auth()->user()?->isAdmin();

        return $table
            ->defaultSort('deadline')
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('project.name')->label('Project')->sortable()->searchable(),
                TextColumn::make('assignee.name')->label('Assigned To')->sortable()->visible($isAdmin),
                TextColumn::make('priority')
                    ->badge()
                    ->formatStateUsing(fn ($state) => CrmTask::PRIORITIES[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        'high' => 'danger',
                        'medium' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('deadline')->date()->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => CrmTask::STATUSES[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        'completed' => 'success',
                        'in_progress' => 'info',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('crm_project_id')->label('Project')->relationship('project', 'name'),
                SelectFilter::make('assigned_user_id')->label('Team Member')->relationship('assignee', 'name')->visible($isAdmin),
                SelectFilter::make('status')->options(CrmTask::STATUSES),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible($isAdmin),
                ]),
            ]);
    }
}
