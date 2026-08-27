<?php

namespace App\Filament\Resources\CrmProjects;

use App\Filament\Concerns\HasCrmAccess;
use App\Filament\Resources\CrmProjects\Pages\CreateCrmProject;
use App\Filament\Resources\CrmProjects\Pages\EditCrmProject;
use App\Filament\Resources\CrmProjects\Pages\ListCrmProjects;
use App\Filament\Resources\CrmProjects\Pages\ViewCrmProject;
use App\Filament\Resources\CrmProjects\RelationManagers\ExpensesRelationManager;
use App\Filament\Resources\CrmProjects\RelationManagers\PaymentsRelationManager;
use App\Filament\Resources\CrmProjects\RelationManagers\TasksRelationManager;
use App\Filament\Resources\CrmProjects\Schemas\CrmProjectForm;
use App\Filament\Resources\CrmProjects\Schemas\CrmProjectInfolist;
use App\Filament\Resources\CrmProjects\Tables\CrmProjectsTable;
use App\Models\CrmProject;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CrmProjectResource extends Resource
{
    use HasCrmAccess;

    protected static ?string $model = CrmProject::class;

    protected static ?string $navigationLabel = 'Projects';

    protected static ?string $modelLabel = 'Project';

    protected static ?string $pluralModelLabel = 'Projects';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static string|\UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return CrmProjectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CrmProjectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CrmProjectsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return static::scopeToAssignedProjects(parent::getEloquentQuery());
    }

    public static function canView(Model $record): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        return $record->teamMembers()->where('users.id', $user->id)->exists();
    }

    public static function canEdit(Model $record): bool
    {
        return static::userIsAdmin();
    }

    public static function getRelations(): array
    {
        return [
            TasksRelationManager::class,
            ExpensesRelationManager::class,
            PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCrmProjects::route('/'),
            'create' => CreateCrmProject::route('/create'),
            'view' => ViewCrmProject::route('/{record}'),
            'edit' => EditCrmProject::route('/{record}/edit'),
        ];
    }
}
