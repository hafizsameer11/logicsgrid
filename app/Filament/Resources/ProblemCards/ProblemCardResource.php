<?php

namespace App\Filament\Resources\ProblemCards;

use App\Filament\Resources\ProblemCards\Pages\CreateProblemCard;
use App\Filament\Resources\ProblemCards\Pages\EditProblemCard;
use App\Filament\Resources\ProblemCards\Pages\ListProblemCards;
use App\Filament\Resources\ProblemCards\Schemas\ProblemCardForm;
use App\Filament\Resources\ProblemCards\Tables\ProblemCardsTable;
use App\Models\ProblemCard;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProblemCardResource extends Resource
{
    protected static ?string $model = ProblemCard::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|\UnitEnum|null $navigationGroup = 'Homepage Sections';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return ProblemCardForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProblemCardsTable::configure($table);
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
            'index' => ListProblemCards::route('/'),
            'create' => CreateProblemCard::route('/create'),
            'edit' => EditProblemCard::route('/{record}/edit'),
        ];
    }
}
