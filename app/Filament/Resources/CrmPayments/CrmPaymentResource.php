<?php

namespace App\Filament\Resources\CrmPayments;

use App\Filament\Concerns\HasCrmAccess;
use App\Filament\Resources\CrmPayments\Pages\CreateCrmPayment;
use App\Filament\Resources\CrmPayments\Pages\EditCrmPayment;
use App\Filament\Resources\CrmPayments\Pages\ListCrmPayments;
use App\Filament\Resources\CrmPayments\Schemas\CrmPaymentForm;
use App\Filament\Resources\CrmPayments\Tables\CrmPaymentsTable;
use App\Models\CrmPayment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CrmPaymentResource extends Resource
{
    use HasCrmAccess;

    protected static ?string $model = CrmPayment::class;

    protected static ?string $navigationLabel = 'Payments';

    protected static ?string $modelLabel = 'Payment';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected static string|\UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 4;

    public static function canViewAny(): bool
    {
        return static::userIsAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return CrmPaymentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CrmPaymentsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCrmPayments::route('/'),
            'create' => CreateCrmPayment::route('/create'),
            'edit' => EditCrmPayment::route('/{record}/edit'),
        ];
    }
}
