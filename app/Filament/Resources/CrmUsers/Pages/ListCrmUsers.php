<?php

namespace App\Filament\Resources\CrmUsers\Pages;

use App\Filament\Resources\CrmUsers\CrmUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCrmUsers extends ListRecords
{
    protected static string $resource = CrmUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
