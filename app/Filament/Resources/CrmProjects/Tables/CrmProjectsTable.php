<?php

namespace App\Filament\Resources\CrmProjects\Tables;

use App\Models\CrmProject;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CrmProjectsTable
{
    public static function configure(Table $table): Table
    {
        $isAdmin = auth()->user()?->isAdmin();

        return $table
            ->defaultSort('deadline')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project_value')
                    ->label('Value')
                    ->money('USD')
                    ->sortable()
                    ->visible($isAdmin),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => CrmProject::STATUSES[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'in_progress' => 'info',
                        'on_hold' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('deadline')
                    ->date()
                    ->sortable(),
                TextColumn::make('received')
                    ->label('Received')
                    ->state(fn (CrmProject $record): float => $record->totalPaymentsReceived())
                    ->money('USD')
                    ->visible($isAdmin),
                TextColumn::make('remaining')
                    ->label('Remaining')
                    ->state(fn (CrmProject $record): float => $record->remainingPayment())
                    ->money('USD')
                    ->visible($isAdmin),
                TextColumn::make('teamMembers_count')
                    ->counts('teamMembers')
                    ->label('Team'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(CrmProject::STATUSES),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()->visible($isAdmin),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible($isAdmin),
                ]),
            ]);
    }
}
