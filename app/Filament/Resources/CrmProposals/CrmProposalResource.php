<?php

namespace App\Filament\Resources\CrmProposals;

use App\Filament\Concerns\HasCrmAccess;
use App\Filament\Resources\CrmProposals\Pages\CreateCrmProposal;
use App\Filament\Resources\CrmProposals\Pages\EditCrmProposal;
use App\Filament\Resources\CrmProposals\Pages\ListCrmProposals;
use App\Filament\Resources\CrmProposals\Schemas\CrmProposalForm;
use App\Filament\Resources\CrmProposals\Tables\CrmProposalsTable;
use App\Models\CrmProposal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CrmProposalResource extends Resource
{
    use HasCrmAccess;

    protected static ?string $model = CrmProposal::class;

    protected static ?string $navigationLabel = 'Proposals';

    protected static ?string $modelLabel = 'Proposal';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|\UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 6;

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
        return static::userIsAdmin();
    }

    public static function form(Schema $schema): Schema
    {
        return CrmProposalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CrmProposalsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCrmProposals::route('/'),
            'create' => CreateCrmProposal::route('/create'),
            'edit' => EditCrmProposal::route('/{record}/edit'),
        ];
    }
}
