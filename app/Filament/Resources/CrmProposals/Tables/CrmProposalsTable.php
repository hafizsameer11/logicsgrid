<?php

namespace App\Filament\Resources\CrmProposals\Tables;

use App\Models\CrmProposal;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CrmProposalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('submitted_at', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                TextColumn::make('client_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('link')
                    ->label('Link')
                    ->url(fn (?string $state): ?string => $state)
                    ->openUrlInNewTab()
                    ->limit(30)
                    ->placeholder('—'),
                TextColumn::make('proposed_amount')
                    ->label('Amount')
                    ->money('USD')
                    ->placeholder('—'),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => CrmProposal::STATUSES[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        'won' => 'success',
                        'lost' => 'danger',
                        'in_discussion' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('submitted_at')
                    ->label('Submitted')
                    ->date()
                    ->sortable(),
                TextColumn::make('creator.name')
                    ->label('Added By')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->options(CrmProposal::STATUSES),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
