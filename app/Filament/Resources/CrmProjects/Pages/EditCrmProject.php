<?php

namespace App\Filament\Resources\CrmProjects\Pages;

use App\Filament\Resources\CrmProjects\CrmProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCrmProject extends EditRecord
{
    protected static string $resource = CrmProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
