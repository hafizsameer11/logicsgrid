<?php

namespace App\Filament\Resources\MarqueeItems;

use App\Filament\Resources\MarqueeItems\Pages\CreateMarqueeItem;
use App\Filament\Resources\MarqueeItems\Pages\EditMarqueeItem;
use App\Filament\Resources\MarqueeItems\Pages\ListMarqueeItems;
use App\Filament\Resources\MarqueeItems\Schemas\MarqueeItemForm;
use App\Filament\Resources\MarqueeItems\Tables\MarqueeItemsTable;
use App\Models\MarqueeItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MarqueeItemResource extends Resource
{
    protected static ?string $model = MarqueeItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Site Settings';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return MarqueeItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MarqueeItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMarqueeItems::route('/'),
            'create' => CreateMarqueeItem::route('/create'),
            'edit' => EditMarqueeItem::route('/{record}/edit'),
        ];
    }
}
