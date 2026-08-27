<?php

namespace App\Filament\Resources\CrmPayments\Schemas;

use App\Models\CrmPayment;
use App\Models\CrmProject;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CrmPaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('crm_project_id')
                    ->label('Project')
                    ->options(fn () => CrmProject::query()->orderBy('name')->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->native(false),
                TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->minValue(0.01)
                    ->prefix('$'),
                DatePicker::make('payment_date')
                    ->required()
                    ->native(false)
                    ->default(now()),
                Select::make('status')
                    ->options(CrmPayment::STATUSES)
                    ->required()
                    ->native(false)
                    ->default('paid'),
            ]);
    }
}
