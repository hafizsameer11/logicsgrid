<?php

namespace App\Filament\Resources\CrmProposals\Pages;

use App\Filament\Resources\CrmProposals\CrmProposalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCrmProposals extends ListRecords
{
    protected static string $resource = CrmProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
