<?php

namespace App\Filament\Resources\CrmUsers\Pages;

use App\Filament\Resources\CrmUsers\CrmUserResource;
use Filament\Resources\Pages\EditRecord;

class EditCrmUser extends EditRecord
{
    protected static string $resource = CrmUserResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
