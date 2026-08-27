<?php

namespace App\Filament\Resources\CrmPayments\Pages;

use App\Filament\Resources\CrmPayments\CrmPaymentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCrmPayment extends EditRecord
{
    protected static string $resource = CrmPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
