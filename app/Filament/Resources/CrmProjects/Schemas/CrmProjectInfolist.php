<?php

namespace App\Filament\Resources\CrmProjects\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CrmProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        $isAdmin = auth()->user()?->isAdmin();

        return $schema
            ->components([
                Section::make('Project Overview')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('name')->columnSpanFull(),
                        TextEntry::make('status')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => \App\Models\CrmProject::STATUSES[$state] ?? $state),
                        TextEntry::make('start_date')->date(),
                        TextEntry::make('deadline')->date(),
                        TextEntry::make('teamMembers.name')
                            ->label('Team Members')
                            ->badge()
                            ->separator(',')
                            ->placeholder('None assigned')
                            ->columnSpanFull(),
                    ]),
                Section::make('Financial Summary')
                    ->columns(3)
                    ->visible($isAdmin)
                    ->schema([
                        TextEntry::make('project_value')
                            ->label('Project Value')
                            ->money('USD'),
                        TextEntry::make('total_received')
                            ->label('Payments Received')
                            ->state(fn ($record) => $record->totalPaymentsReceived())
                            ->money('USD'),
                        TextEntry::make('remaining')
                            ->label('Remaining Payment')
                            ->state(fn ($record) => $record->remainingPayment())
                            ->money('USD'),
                        TextEntry::make('total_expenses')
                            ->label('Total Expenses')
                            ->state(fn ($record) => $record->totalExpenses())
                            ->money('USD'),
                        TextEntry::make('profit')
                            ->label('Project Profit')
                            ->state(fn ($record) => $record->profit())
                            ->money('USD'),
                        TextEntry::make('payment_status')
                            ->label('Payment Status')
                            ->state(fn ($record) => $record->paymentStatusLabel())
                            ->badge(),
                    ]),
            ]);
    }
}
