<?php

namespace App\Filament\Resources;

use Illuminate\Support\Str;
use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo'; // Icon ganti biar lebih relevan
    protected static ?string $navigationGroup = 'Content Management'; // Kelompokkan menu (opsional)

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Slider Content')
                    ->description('Manage the main visuals and text for the homepage hero section.')
                    ->schema([
                        Forms\Components\TextInput::make('headline')
                            ->label('Main Headline')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('subheadline')
                            ->label('Sub Headline / Description')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->label('Background Image')
                            ->image()
                            ->directory('sliders')
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull()
                            ->getUploadedFileNameForStorageUsing(
                                fn (Forms\Get $get, $file): string =>
                                    Str::slug($get('headline') ?? 'slider-' . time()) . '.' . $file->getClientOriginalExtension()
                            ),
                    ]),

                Forms\Components\Section::make('Call to Action (Optional)')
                    ->schema([
                        Forms\Components\TextInput::make('cta_text')
                            ->label('Button Text')
                            ->placeholder('e.g. Read More')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('cta_url')
                            ->label('Button URL')
                            ->placeholder('https://...')
                            ->maxLength(255)
                            ->url(), // Validasi format URL
                    ])->columns(2),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->label('Display Order')
                            ->helperText('Lower numbers appear first.')
                            ->required()
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Status')
                            ->onColor('success')
                            ->offColor('danger')
                            ->required()
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Preview')
                    ->circular(), // Tampilan bulat biar kece

                Tables\Columns\TextColumn::make('headline')
                    ->searchable()
                    ->sortable()
                    ->limit(30), // Potong teks kalau kepanjangan

                Tables\Columns\TextColumn::make('cta_text')
                    ->label('Button')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\ToggleColumn::make('is_active') // Bisa switch ON/OFF langsung di tabel!
                    ->label('Active'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->since() // Tampilkan "2 hours ago"
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc') // Default urutan berdasarkan order
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        true => 'Active',
                        false => 'Inactive',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
