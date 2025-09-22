<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use App\Models\Type;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('client')
                    ->required(),
                TextInput::make('location')
                    ->required(),
                Select::make('type_id')
                    ->label('Type')
                    ->options(Type::pluck('name', 'id')->toArray()) // ambil dari tabel types
                    ->required()
                    ->searchable(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
