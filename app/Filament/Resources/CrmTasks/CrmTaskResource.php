<?php

namespace App\Filament\Resources\CrmTasks;

use App\Filament\Concerns\HasCrmAccess;
use App\Filament\Resources\CrmTasks\Pages\CreateCrmTask;
use App\Filament\Resources\CrmTasks\Pages\EditCrmTask;
use App\Filament\Resources\CrmTasks\Pages\ListCrmTasks;
use App\Filament\Resources\CrmTasks\Schemas\CrmTaskForm;
use App\Filament\Resources\CrmTasks\Tables\CrmTasksTable;
use App\Models\CrmTask;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CrmTaskResource extends Resource
{
    use HasCrmAccess;

    protected static ?string $model = CrmTask::class;

    protected static ?string $navigationLabel = 'Tasks';

    protected static ?string $modelLabel = 'Task';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static string|\UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return CrmTaskForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CrmTasksTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = auth()->user();

        if ($user && $user->isTeamMember()) {
            $query->where('assigned_user_id', $user->id);
        }

        return $query;
    }

    public static function canCreate(): bool
    {
        return static::userIsAdmin();
    }

    public static function canEdit(Model $record): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        return $record->assigned_user_id === $user->id;
    }

    public static function canDelete(Model $record): bool
    {
        return static::userIsAdmin();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCrmTasks::route('/'),
            'create' => CreateCrmTask::route('/create'),
            'edit' => EditCrmTask::route('/{record}/edit'),
        ];
    }
}
