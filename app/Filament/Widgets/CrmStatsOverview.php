<?php

namespace App\Filament\Widgets;

use App\Models\CrmExpense;
use App\Models\CrmPayment;
use App\Models\CrmProject;
use App\Models\CrmProposal;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CrmStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    protected function getStats(): array
    {
        $totalProjects = CrmProject::count();
        $activeProjects = CrmProject::where('status', 'in_progress')->count();
        $completedProjects = CrmProject::where('status', 'completed')->count();
        $totalValue = (float) CrmProject::sum('project_value');
        $totalReceived = (float) CrmPayment::sum('amount');
        $totalExpenses = (float) CrmExpense::sum('amount');
        $pendingPayments = max(0, $totalValue - $totalReceived);
        $totalProfit = $totalValue - $totalExpenses;
        $wonProposals = CrmProposal::where('status', 'won')->count();
        $unansweredProposals = CrmProposal::where('status', 'unanswered')->count();

        return [
            Stat::make('Total Projects', (string) $totalProjects),
            Stat::make('Active Projects', (string) $activeProjects),
            Stat::make('Completed Projects', (string) $completedProjects),
            Stat::make('Total Project Value', '$'.number_format($totalValue, 2)),
            Stat::make('Payments Received', '$'.number_format($totalReceived, 2)),
            Stat::make('Pending Payments', '$'.number_format($pendingPayments, 2)),
            Stat::make('Total Expenses', '$'.number_format($totalExpenses, 2)),
            Stat::make('Total Profit', '$'.number_format($totalProfit, 2)),
            Stat::make('Proposals Won', (string) $wonProposals),
            Stat::make('Proposals Unanswered', (string) $unansweredProposals),
        ];
    }
}
