<?php

namespace App\Filament\Resources\PortfolioPhotoResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class PortfolioPhotosTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([

            ImageColumn::make('image_path')
                ->label('Photo')
                ->square(),

            TextColumn::make('portfolio.portfolio_name')
                ->label('Portfolio')
                ->searchable(),

            TextColumn::make('caption')
                ->limit(30),

            IconColumn::make('is_cover')
                ->boolean()
                ->label('Cover?'),

            TextColumn::make('sort_order')
                ->sortable(),

        ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
