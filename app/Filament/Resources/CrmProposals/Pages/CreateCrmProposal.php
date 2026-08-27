<?php

namespace App\Filament\Resources\CrmProposals\Pages;

use App\Filament\Resources\CrmProposals\CrmProposalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCrmProposal extends CreateRecord
{
    protected static string $resource = CrmProposalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }
}
