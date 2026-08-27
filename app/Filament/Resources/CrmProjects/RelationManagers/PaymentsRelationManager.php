<?php

namespace App\Filament\Resources\CrmProjects\RelationManagers;

use App\Models\CrmPayment;
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

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    public static function canViewForRecord($ownerRecord, string $pageClass): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')->required()->numeric()->minValue(0.01)->prefix('$'),
                DatePicker::make('payment_date')->required()->native(false)->default(now()),
                Select::make('status')->options(CrmPayment::STATUSES)->required()->native(false)->default('paid'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('amount')->money('USD'),
                TextColumn::make('payment_date')->date(),
                TextColumn::make('status')->badge()->formatStateUsing(fn ($state) => CrmPayment::STATUSES[$state] ?? $state),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
