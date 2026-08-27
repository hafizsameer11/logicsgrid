<?php

namespace App\Filament\Resources\CrmExpenses\Pages;

use App\Filament\Resources\CrmExpenses\CrmExpenseResource;
use Filament\Resources\Pages\EditRecord;

class EditCrmExpense extends EditRecord
{
    protected static string $resource = CrmExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();

        if (($data['type'] ?? '') === 'fixed') {
            $data['crm_project_id'] = null;
            if (! empty($data['is_recurring'])) {
                $data['recurrence'] = $data['recurrence'] ?? 'monthly';
            }
        } else {
            $data['title'] = null;
            $data['is_recurring'] = false;
            $data['recurrence'] = null;
        }

        return $data;
    }
}
