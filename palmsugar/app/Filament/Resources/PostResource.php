<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // === KOLOM KIRI (Konten Utama) ===
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Article Content')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    )
                                    ->maxLength(255),

                                // Slug di-hidden aja biar bersih, tapi tetep kesimpen
                                Forms\Components\Hidden::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                Forms\Components\RichEditor::make('content')
                                    ->required()
                                    ->fileAttachmentsDirectory('posts/content')
                                    ->columnSpanFull(),
                            ]),

                        Forms\Components\Section::make('Thumbnail')
                            ->schema([
                                Forms\Components\FileUpload::make('thumbnail')
                                    ->image()
                                    ->directory('posts/thumbnails')
                                    ->imageEditor()
                                    ->getUploadedFileNameForStorageUsing(
                                        fn (Forms\Get $get, $file): string =>
                                            Str::slug($get('title') ?? 'post-' . time()) . '.' . $file->getClientOriginalExtension()
                                    )
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]), // Lebar 2/3

                // === KOLOM KANAN (Settings) ===
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Publishing')
                            ->schema([
                                Forms\Components\DatePicker::make('published_at')
                                    ->label('Publish Date')
                                    ->default(now()),

                                Forms\Components\Toggle::make('is_published')
                                    ->label('Published')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(true),

                                Forms\Components\Hidden::make('user_id')
                                    ->default(fn () => auth()->id())
                                    ->required(),
                            ]),

                        Forms\Components\Section::make('Meta Info')
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (Post $record): string => $record->created_at?->diffForHumans() ?? '-'),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified')
                                    ->content(fn (Post $record): string => $record->updated_at?->diffForHumans() ?? '-'),
                            ])
                            ->hidden(fn (?Post $record) => $record === null),
                    ])
                    ->columnSpan(['lg' => 1]), // Lebar 1/3
            ])
            ->columns(3); // Total grid 3 kolom
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->square()
                    ->label('Image'),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author')
                    ->sortable()
                    ->icon('heroicon-m-user')
                    ->color('gray'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('published_at')
                    ->date()
                    ->sortable()
                    ->label('Date'),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Publication Status'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
