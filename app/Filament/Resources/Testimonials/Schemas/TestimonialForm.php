<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('quote')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                TextInput::make('author')
                    ->required()
                    ->maxLength(255),
                TextInput::make('role')
                    ->maxLength(255),
                Toggle::make('is_dark')
                    ->default(false),
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
