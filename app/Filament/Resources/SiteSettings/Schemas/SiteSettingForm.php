<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('group')
                    ->required()
                    ->maxLength(255),
                TextInput::make('key')
                    ->required()
                    ->maxLength(255),
                Textarea::make('value')
                    ->rows(5)
                    ->columnSpanFull(),
                Select::make('type')
                    ->options([
                        'text' => 'Text',
                        'json' => 'JSON',
                        'boolean' => 'Boolean',
                        'image' => 'Image',
                    ])
                    ->default('text')
                    ->required(),
            ]);
    }
}
