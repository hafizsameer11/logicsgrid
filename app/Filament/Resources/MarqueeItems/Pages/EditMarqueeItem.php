<?php

namespace App\Filament\Resources\MarqueeItems\Pages;

use App\Filament\Resources\MarqueeItems\MarqueeItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMarqueeItem extends EditRecord
{
    protected static string $resource = MarqueeItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
