<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('role_badge')
                    ->maxLength(255),
                TextInput::make('title')
                    ->maxLength(255),
                Textarea::make('bio')
                    ->rows(4)
                    ->columnSpanFull(),
                FileUpload::make('photo')
                    ->image()
                    ->directory('team'),
                TextInput::make('location')
                    ->maxLength(255),
                TextInput::make('initials')
                    ->maxLength(255),
                TagsInput::make('skills'),
                Select::make('section')
                    ->options([
                        'partners' => 'Partners',
                        'crew' => 'Crew',
                        'home' => 'Home',
                    ])
                    ->default('crew')
                    ->required(),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_featured')
                    ->default(false),
                Toggle::make('is_published')
                    ->default(true),
            ]);
    }
}
