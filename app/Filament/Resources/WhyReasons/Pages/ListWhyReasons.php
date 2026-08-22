<?php

namespace App\Filament\Resources\WhyReasons\Pages;

use App\Filament\Resources\WhyReasons\WhyReasonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWhyReasons extends ListRecords
{
    protected static string $resource = WhyReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
