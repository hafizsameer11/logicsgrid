<?php

namespace App\Filament\Resources\WhyReasons\Pages;

use App\Filament\Resources\WhyReasons\WhyReasonResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWhyReason extends EditRecord
{
    protected static string $resource = WhyReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
