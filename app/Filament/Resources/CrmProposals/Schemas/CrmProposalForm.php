<?php

namespace App\Filament\Resources\CrmProposals\Schemas;

use App\Models\CrmProposal;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CrmProposalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Proposal / Job Title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('client_name')
                    ->label('Client Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('client_email')
                    ->label('Client Email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('client_company')
                    ->label('Client Company')
                    ->maxLength(255),
                TextInput::make('link')
                    ->label('Link')
                    ->url()
                    ->placeholder('https://...')
                    ->helperText('Job or proposal link (Upwork, website, email thread, etc.)')
                    ->maxLength(2048)
                    ->columnSpanFull(),
                TextInput::make('proposed_amount')
                    ->label('Proposed Amount')
                    ->numeric()
                    ->minValue(0)
                    ->prefix('$'),
                Select::make('status')
                    ->options(CrmProposal::STATUSES)
                    ->required()
                    ->native(false)
                    ->default('unanswered'),
                DatePicker::make('submitted_at')
                    ->label('Submitted Date')
                    ->native(false)
                    ->default(now()),
                Textarea::make('notes')
                    ->label('Notes')
                    ->rows(4)
                    ->helperText('Optional notes — useful to compare what worked on won proposals vs unanswered ones.')
                    ->columnSpanFull(),
            ]);
    }
}
