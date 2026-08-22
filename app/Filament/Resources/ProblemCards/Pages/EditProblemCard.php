<?php

namespace App\Filament\Resources\ProblemCards\Pages;

use App\Filament\Resources\ProblemCards\ProblemCardResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProblemCard extends EditRecord
{
    protected static string $resource = ProblemCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
