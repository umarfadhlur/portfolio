<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RsvpResponseResource\Pages;
use App\Models\RsvpResponse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RsvpResponseResource extends Resource
{
    protected static ?string $model = RsvpResponse::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'RSVP Masuk';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Nama')->required(),
            Forms\Components\TextInput::make('phone')->label('WhatsApp')->required(),
            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'hadir' => '✓ Hadir',
                    'tidak_hadir' => '✗ Tidak Hadir',
                    'ragu' => '? Masih Ragu',
                ])
                ->required(),
            Forms\Components\TextInput::make('number_of_guests')
                ->label('Jumlah Tamu')
                ->numeric()
                ->default(1),
            Forms\Components\Textarea::make('message')->label('Pesan')->rows(4),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone')->label('WhatsApp')->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'hadir',
                        'danger' => 'tidak_hadir',
                        'warning' => 'ragu',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'hadir' => 'Hadir',
                        'tidak_hadir' => 'Tidak Hadir',
                        'ragu' => 'Masih Ragu',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('number_of_guests')->label('Jumlah'),
                Tables\Columns\TextColumn::make('message')->label('Pesan')->limit(40),
                Tables\Columns\TextColumn::make('created_at')->label('Waktu')->dateTime('d M H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'hadir' => 'Hadir',
                        'tidak_hadir' => 'Tidak Hadir',
                        'ragu' => 'Masih Ragu',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRsvpResponses::route('/'),
            'create' => Pages\CreateRsvpResponse::route('/create'),
            'edit' => Pages\EditRsvpResponse::route('/{record}/edit'),
        ];
    }
}
