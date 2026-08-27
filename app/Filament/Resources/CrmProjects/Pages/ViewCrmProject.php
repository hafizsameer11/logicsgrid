<?php

namespace App\Filament\Resources\CrmProjects\Pages;

use App\Filament\Resources\CrmProjects\CrmProjectResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCrmProject extends ViewRecord
{
    protected static string $resource = CrmProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->visible(fn () => auth()->user()?->isAdmin()),
        ];
    }
}
