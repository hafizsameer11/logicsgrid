<?php

namespace App\Filament\Resources\WhyReasons;

use App\Filament\Resources\WhyReasons\Pages\CreateWhyReason;
use App\Filament\Resources\WhyReasons\Pages\EditWhyReason;
use App\Filament\Resources\WhyReasons\Pages\ListWhyReasons;
use App\Filament\Resources\WhyReasons\Schemas\WhyReasonForm;
use App\Filament\Resources\WhyReasons\Tables\WhyReasonsTable;
use App\Models\WhyReason;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WhyReasonResource extends Resource
{
    protected static ?string $model = WhyReason::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Homepage Sections';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return WhyReasonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WhyReasonsTable::configure($table);
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
            'index' => ListWhyReasons::route('/'),
            'create' => CreateWhyReason::route('/create'),
            'edit' => EditWhyReason::route('/{record}/edit'),
        ];
    }
}
