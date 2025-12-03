<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('portfolio_name')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('roles')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('contributions')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('tech_stack')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
