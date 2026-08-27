<?php

namespace App\Filament\Resources\CrmUsers\Pages;

use App\Filament\Resources\CrmUsers\CrmUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCrmUser extends CreateRecord
{
    protected static string $resource = CrmUserResource::class;
}
