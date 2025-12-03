<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvitationSettingResource\Pages;
use App\Models\InvitationSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InvitationSettingResource extends Resource
{
    protected static ?string $model = InvitationSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Undangan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Pengantin')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('bride_name')
                        ->label('Nama Mempelai Wanita')
                        ->required(),
                    Forms\Components\TextInput::make('groom_name')
                        ->label('Nama Mempelai Pria')
                        ->required(),
                ]),

            Forms\Components\Section::make('Tanggal & Waktu')
                ->columns(3)
                ->schema([
                    Forms\Components\DatePicker::make('wedding_date')
                        ->label('Tanggal Pernikahan')
                        ->required(),
                    Forms\Components\TimePicker::make('akad_time')
                        ->label('Waktu Akad')
                        ->required(),
                    Forms\Components\TimePicker::make('resepsi_time')
                        ->label('Waktu Resepsi')
                        ->required(),
                ]),

            Forms\Components\Section::make('Lokasi Akad')
                ->schema([
                    Forms\Components\TextInput::make('akad_location')
                        ->label('Nama Tempat')
                        ->required(),
                    Forms\Components\Textarea::make('akad_address')
                        ->label('Alamat')
                        ->required()
                        ->rows(3),
                    Forms\Components\TextInput::make('akad_map_link')
                        ->label('Link Google Maps')
                        ->url()
                        ->nullable(),
                ]),

            Forms\Components\Section::make('Lokasi Resepsi')
                ->schema([
                    Forms\Components\TextInput::make('resepsi_location')
                        ->label('Nama Tempat')
                        ->required(),
                    Forms\Components\Textarea::make('resepsi_address')
                        ->label('Alamat')
                        ->required()
                        ->rows(3),
                    Forms\Components\TextInput::make('resepsi_map_link')
                        ->label('Link Google Maps')
                        ->url()
                        ->nullable(),
                ]),

            Forms\Components\Section::make('Media & File')
                ->columns(2)
                ->schema([
                    Forms\Components\FileUpload::make('hero_image')
                        ->label('Foto Hero')
                        ->image()
                        ->directory('invitation/hero'),
                    Forms\Components\FileUpload::make('music_file')
                        ->label('Musik Background (MP3)')
                        ->directory('invitation/music'),
                    Forms\Components\FileUpload::make('qris_image')
                        ->label('QR Code QRIS')
                        ->image()
                        ->directory('invitation/qris'),
                ]),

            Forms\Components\Section::make('Tema Warna')
                ->columns(2)
                ->schema([
                    Forms\Components\ColorPicker::make('theme_primary_color')
                        ->label('Warna Primer (Sage)')
                        ->default('#C7D3C0'),
                    Forms\Components\ColorPicker::make('theme_secondary_color')
                        ->label('Warna Sekunder (Silver)')
                        ->default('#C0C0C0'),
                ]),

            Forms\Components\Section::make('Bank Info')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('bank_name')
                        ->label('Nama Bank')
                        ->nullable(),
                    Forms\Components\TextInput::make('bank_account_number')
                        ->label('Nomor Rekening')
                        ->nullable(),
                    Forms\Components\TextInput::make('bank_account_name')
                        ->label('Atas Nama')
                        ->nullable(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bride_name')->label('Mempelai Wanita'),
                Tables\Columns\TextColumn::make('groom_name')->label('Mempelai Pria'),
                Tables\Columns\TextColumn::make('wedding_date')->label('Tanggal')->date('d F Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvitationSettings::route('/'),
            'edit' => Pages\EditInvitationSetting::route('/{record}/edit'),
        ];
    }
}
