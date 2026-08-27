<?php

namespace App\Filament\Resources\CrmProjects\Pages;

use App\Filament\Resources\CrmProjects\CrmProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCrmProjects extends ListRecords
{
    protected static string $resource = CrmProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->visible(fn () => auth()->user()?->isAdmin()),
        ];
    }
}
