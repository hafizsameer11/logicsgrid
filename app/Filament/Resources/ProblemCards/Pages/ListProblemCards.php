<?php

namespace App\Filament\Resources\ProblemCards\Pages;

use App\Filament\Resources\ProblemCards\ProblemCardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProblemCards extends ListRecords
{
    protected static string $resource = ProblemCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
