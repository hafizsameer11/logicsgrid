<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Overview')
                    ->schema([
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('subtitle')
                            ->maxLength(255),
                        TextInput::make('client_name')
                            ->maxLength(255),
                        TextInput::make('location')
                            ->maxLength(255),
                        TextInput::make('category')
                            ->maxLength(255),
                        TextInput::make('year')
                            ->maxLength(255),
                        TextInput::make('engagement_type')
                            ->maxLength(255),
                        FileUpload::make('cover_image')
                            ->image()
                            ->directory('projects'),
                        Textarea::make('excerpt')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Case Study')
                    ->schema([
                        Textarea::make('challenge')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('approach')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('outcome')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
                Section::make('Project Details')
                    ->schema([
                        TextInput::make('duration')
                            ->maxLength(255),
                        TextInput::make('team_info')
                            ->maxLength(255),
                        TextInput::make('live_url')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('live_label')
                            ->maxLength(255),
                        TextInput::make('app_store_url')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('play_store_url')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Section::make('Featured & Deliverables')
                    ->schema([
                        TextInput::make('featured_stat_value')
                            ->maxLength(255),
                        TextInput::make('featured_stat_label')
                            ->maxLength(255),
                        TagsInput::make('technologies')
                            ->columnSpanFull(),
                        TagsInput::make('deliverables')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Publishing')
                    ->schema([
                        TextInput::make('meta_title')
                            ->maxLength(255),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_featured')
                            ->default(false),
                        Toggle::make('is_published')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
