<?php

namespace App\Filament\Widgets;

use App\Models\CrmTask;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CrmTeamMemberStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return auth()->user()?->isTeamMember() ?? false;
    }

    protected function getStats(): array
    {
        $userId = auth()->id();

        return [
            Stat::make('My Tasks', (string) CrmTask::where('assigned_user_id', $userId)->count()),
            Stat::make('In Progress', (string) CrmTask::where('assigned_user_id', $userId)->where('status', 'in_progress')->count()),
            Stat::make('Completed', (string) CrmTask::where('assigned_user_id', $userId)->where('status', 'completed')->count()),
            Stat::make('Pending', (string) CrmTask::where('assigned_user_id', $userId)->where('status', 'pending')->count()),
        ];
    }
}
