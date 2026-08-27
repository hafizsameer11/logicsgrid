<?php

namespace App\Filament\Resources\CrmPayments\Pages;

use App\Filament\Resources\CrmPayments\CrmPaymentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCrmPayments extends ListRecords
{
    protected static string $resource = CrmPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
