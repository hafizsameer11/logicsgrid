<?php

namespace App\Filament\Resources\CrmExpenses\Schemas;

use App\Models\CrmExpense;
use App\Models\CrmProject;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class CrmExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options(CrmExpense::TYPES)
                    ->required()
                    ->native(false)
                    ->default('project')
                    ->live(),
                Select::make('crm_project_id')
                    ->label('Project')
                    ->options(fn () => CrmProject::query()->orderBy('name')->pluck('name', 'id'))
                    ->searchable()
                    ->native(false)
                    ->required(fn (Get $get): bool => $get('type') === 'project')
                    ->visible(fn (Get $get): bool => $get('type') === 'project'),
                TextInput::make('title')
                    ->label('Expense Title')
                    ->placeholder('e.g. Salaries, AWS Subscription, Office Rent')
                    ->maxLength(255)
                    ->required(fn (Get $get): bool => $get('type') === 'fixed')
                    ->visible(fn (Get $get): bool => $get('type') === 'fixed'),
                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->minValue(0.01)
                    ->prefix('$'),
                DatePicker::make('expense_date')
                    ->label('Expense Date')
                    ->required()
                    ->native(false)
                    ->default(now()),
                Toggle::make('is_recurring')
                    ->label('Recurring Monthly')
                    ->default(false)
                    ->live()
                    ->visible(fn (Get $get): bool => $get('type') === 'fixed'),
                Select::make('recurrence')
                    ->options(['monthly' => 'Monthly'])
                    ->default('monthly')
                    ->native(false)
                    ->visible(fn (Get $get): bool => $get('type') === 'fixed' && $get('is_recurring')),
            ]);
    }
}
