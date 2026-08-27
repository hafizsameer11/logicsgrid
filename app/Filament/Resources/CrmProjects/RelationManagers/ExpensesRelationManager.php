<?php

namespace App\Filament\Resources\CrmProjects\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExpensesRelationManager extends RelationManager
{
    protected static string $relationship = 'expenses';

    public static function canViewForRecord($ownerRecord, string $pageClass): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')->required()->numeric()->minValue(0.01)->prefix('$'),
                DatePicker::make('expense_date')->required()->native(false)->default(now()),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('amount')->money('USD'),
                TextColumn::make('expense_date')->date(),
                TextColumn::make('creator.name')->label('Added By'),
                TextColumn::make('editor.name')->label('Edited By')->placeholder('—'),
                TextColumn::make('updated_at')->dateTime()->label('Last Updated'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['type'] = 'project';
                        $data['created_by'] = auth()->id();
                        $data['updated_by'] = auth()->id();

                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['updated_by'] = auth()->id();

                        return $data;
                    }),
            ]);
    }
}
