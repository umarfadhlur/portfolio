<?php

namespace App\Filament\Resources\Experiences\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExperiencesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('client')
                    ->searchable(),

                TextColumn::make('location')
                    ->searchable(),

                TextColumn::make('type.name')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('start_date')
                    ->date()
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state ? $state->format('M Y') : 'Present'),

                TextColumn::make('end_date')
                    ->date()
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state ? $state->format('M Y') : 'Present'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
