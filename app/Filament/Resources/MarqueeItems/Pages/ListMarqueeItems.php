<?php

namespace App\Filament\Resources\MarqueeItems\Pages;

use App\Filament\Resources\MarqueeItems\MarqueeItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMarqueeItems extends ListRecords
{
    protected static string $resource = MarqueeItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
