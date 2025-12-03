<?php

namespace App\Filament\Resources\PortfolioPhotoResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PortfolioPhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('portfolio_id')
                ->relationship('portfolio', 'portfolio_name')
                ->label('Portfolio')
                ->required(),

            FileUpload::make('image_path')
                ->directory('portfolio')
                ->image()
                ->required(),

            TextInput::make('caption')
                ->nullable()
                ->label('Caption'),

            Toggle::make('is_cover')
                ->label('Cover Photo')
                ->default(false),

            TextInput::make('sort_order')
                ->numeric()
                ->default(1)
                ->label('Sort Order'),
        ]);
    }
}
