<?php

namespace App\Filament\Resources\CrmProposals\Pages;

use App\Filament\Resources\CrmProposals\CrmProposalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCrmProposal extends EditRecord
{
    protected static string $resource = CrmProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
