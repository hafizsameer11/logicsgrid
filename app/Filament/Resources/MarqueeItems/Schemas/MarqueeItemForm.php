<?php

namespace App\Filament\Resources\MarqueeItems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MarqueeItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('text')
                    ->required()
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
