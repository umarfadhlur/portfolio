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
                    ->label('Project Name')
                    ->required(),

                Textarea::make('description')
                    ->label('Short Description')
                    ->rows(4)
                    ->columnSpanFull(),

                Textarea::make('roles')
                    ->label('Roles (JSON Array)')
                    ->rows(3)
                    ->helperText('Example: ["Flutter Developer", "API Integrator"]')
                    ->columnSpanFull(),

                Textarea::make('contributions')
                    ->label('Contributions (JSON Array)')
                    ->rows(5)
                    ->helperText('Example: ["Built app from scratch", "Integrated with API"]')
                    ->columnSpanFull(),

                Textarea::make('tech_stack')
                    ->label('Tech Stack (JSON Array)')
                    ->rows(3)
                    ->helperText('Example: ["Flutter", "Laravel", "REST API"]')
                    ->columnSpanFull(),
            ]);
    }
}
