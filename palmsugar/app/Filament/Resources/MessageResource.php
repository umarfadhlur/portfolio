<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon  = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Messages';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?int    $navigationSort  = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'unread')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Sender Info')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()->maxLength(100),
                    Forms\Components\TextInput::make('email')
                        ->email()->required()->maxLength(100),
                    Forms\Components\TextInput::make('phone')
                        ->tel()->maxLength(20),
                    Forms\Components\TextInput::make('subject')
                        ->maxLength(150),
                ]),

            Forms\Components\Section::make('Message')
                ->schema([
                    Forms\Components\Textarea::make('message')
                        ->required()->rows(5)->columnSpanFull(),
                    Forms\Components\Select::make('status')
                        ->options([
                            'unread'  => 'Unread',
                            'read'    => 'Read',
                            'replied' => 'Replied',
                        ])
                        ->default('unread')
                        ->required(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight(fn ($record) => $record->status === 'unread' ? 'bold' : 'normal'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email copied!'),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('subject')
                    ->limit(30)
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('message')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->message),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger'  => 'unread',
                        'warning' => 'read',
                        'success' => 'replied',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'unread'  => 'Unread',
                        'read'    => 'Read',
                        'replied' => 'Replied',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_read')
                    ->label('Mark Read')
                    ->icon('heroicon-o-check')
                    ->color('warning')
                    ->visible(fn ($record) => $record->status === 'unread')
                    ->action(fn ($record) => $record->update(['status' => 'read'])),

                Tables\Actions\Action::make('mark_replied')
                    ->label('Mark Replied')
                    ->icon('heroicon-o-check-badge')
                    ->color('success')
                    ->visible(fn ($record) => $record->status !== 'replied')
                    ->action(fn ($record) => $record->update(['status' => 'replied'])),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_all_read')
                        ->label('Mark as Read')
                        ->icon('heroicon-o-check')
                        ->action(fn ($records) => $records->each->update(['status' => 'read'])),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
            'view'  => Pages\ViewMessage::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
