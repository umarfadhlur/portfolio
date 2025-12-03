<?php

namespace App\Filament\Resources\PortfolioPhotos;

use App\Filament\Resources\PortfolioPhotos\Pages\CreatePortfolioPhoto;
use App\Filament\Resources\PortfolioPhotos\Pages\EditPortfolioPhoto;
use App\Filament\Resources\PortfolioPhotos\Pages\ListPortfolioPhotos;
use App\Filament\Resources\PortfolioPhotos\Schemas\PortfolioPhotoForm;
use App\Filament\Resources\PortfolioPhotos\Tables\PortfolioPhotosTable;
use App\Models\PortfolioPhoto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PortfolioPhotoResource extends Resource
{
    protected static ?string $model = PortfolioPhoto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Portfolio Photo';

    public static function form(Schema $schema): Schema
    {
        return PortfolioPhotoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PortfolioPhotosTable::configure($table);
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
            'index' => ListPortfolioPhotos::route('/'),
            'create' => CreatePortfolioPhoto::route('/create'),
            'edit' => EditPortfolioPhoto::route('/{record}/edit'),
        ];
    }
}
