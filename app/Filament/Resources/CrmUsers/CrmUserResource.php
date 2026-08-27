<?php

namespace App\Filament\Resources\CrmUsers;

use App\Filament\Concerns\HasCrmAccess;
use App\Filament\Resources\CrmUsers\Pages\CreateCrmUser;
use App\Filament\Resources\CrmUsers\Pages\EditCrmUser;
use App\Filament\Resources\CrmUsers\Pages\ListCrmUsers;
use App\Filament\Resources\CrmUsers\Schemas\CrmUserForm;
use App\Filament\Resources\CrmUsers\Tables\CrmUsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CrmUserResource extends Resource
{
    use HasCrmAccess;

    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Team Members';

    protected static ?string $modelLabel = 'Team Member';

    protected static ?string $pluralModelLabel = 'Team Members';

    protected static ?string $slug = 'crm-team-members';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static string|\UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 5;

    public static function canViewAny(): bool
    {
        return static::userIsAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return CrmUserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CrmUsersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCrmUsers::route('/'),
            'create' => CreateCrmUser::route('/create'),
            'edit' => EditCrmUser::route('/{record}/edit'),
        ];
    }
}
