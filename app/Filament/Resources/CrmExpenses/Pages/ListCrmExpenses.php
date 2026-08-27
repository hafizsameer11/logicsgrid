<?php

namespace App\Filament\Resources\CrmExpenses\Pages;

use App\Filament\Resources\CrmExpenses\CrmExpenseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCrmExpenses extends ListRecords
{
    protected static string $resource = CrmExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
