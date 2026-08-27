<?php

namespace App\Filament\Resources\CrmExpenses\Tables;

use App\Models\CrmExpense;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CrmExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('expense_date', 'desc')
            ->columns([
                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn ($state) => CrmExpense::TYPES[$state] ?? $state)
                    ->color(fn ($state) => $state === 'fixed' ? 'warning' : 'info'),
                TextColumn::make('title')
                    ->label('Title / Project')
                    ->state(fn (CrmExpense $record): string => $record->type === 'fixed'
                        ? ($record->title ?: 'Fixed')
                        : ($record->project?->name ?: '—'))
                    ->searchable(['title']),
                TextColumn::make('amount')->money('USD')->sortable(),
                TextColumn::make('expense_date')->date()->sortable(),
                IconColumn::make('is_recurring')->boolean()->label('Monthly'),
                TextColumn::make('creator.name')->label('Added By'),
                TextColumn::make('editor.name')->label('Last Edited By')->placeholder('—'),
                TextColumn::make('updated_at')->dateTime()->label('Updated'),
            ])
            ->filters([
                SelectFilter::make('type')->options(CrmExpense::TYPES),
                SelectFilter::make('crm_project_id')->label('Project')->relationship('project', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([]);
    }
}
