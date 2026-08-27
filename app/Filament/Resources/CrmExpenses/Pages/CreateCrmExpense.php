<?php

namespace App\Filament\Resources\CrmExpenses\Pages;

use App\Filament\Resources\CrmExpenses\CrmExpenseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCrmExpense extends CreateRecord
{
    protected static string $resource = CrmExpenseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
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
