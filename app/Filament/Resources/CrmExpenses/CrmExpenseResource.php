<?php

namespace App\Filament\Resources\CrmExpenses;

use App\Filament\Concerns\HasCrmAccess;
use App\Filament\Resources\CrmExpenses\Pages\CreateCrmExpense;
use App\Filament\Resources\CrmExpenses\Pages\EditCrmExpense;
use App\Filament\Resources\CrmExpenses\Pages\ListCrmExpenses;
use App\Filament\Resources\CrmExpenses\Schemas\CrmExpenseForm;
use App\Filament\Resources\CrmExpenses\Tables\CrmExpensesTable;
use App\Models\CrmExpense;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CrmExpenseResource extends Resource
{
    use HasCrmAccess;

    protected static ?string $model = CrmExpense::class;

    protected static ?string $navigationLabel = 'Expenses';

    protected static ?string $modelLabel = 'Expense';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static string|\UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool
    {
        return static::userIsAdmin();
    }

    public static function canCreate(): bool
    {
        return static::userIsAdmin();
    }

    public static function canEdit(Model $record): bool
    {
        return static::userIsAdmin();
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return CrmExpenseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CrmExpensesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCrmExpenses::route('/'),
            'create' => CreateCrmExpense::route('/create'),
            'edit' => EditCrmExpense::route('/{record}/edit'),
        ];
    }
}
