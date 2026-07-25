<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Tabs::make('Product')
                ->tabs([

                    // ── TAB 1: General ──
                    Forms\Components\Tabs\Tab::make('General')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) =>
                                    $set('slug', Str::slug($state))),

                            Forms\Components\TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Forms\Components\Textarea::make('description')
                                ->rows(4)
                                ->columnSpanFull(),

                            Forms\Components\FileUpload::make('image')
                                ->image()
                                ->disk('public')
                                ->directory('products')
                                ->imageResizeMode('cover')
                                ->imageCropAspectRatio('16:9')
                                ->maxSize(2048)
                                ->columnSpanFull(),

                            Forms\Components\TextInput::make('category')
                                ->placeholder('crystal, powder, liquid'),

                            Forms\Components\TextInput::make('certifications')
                                ->placeholder('Organic, HACCP, Halal'),

                            Forms\Components\Toggle::make('is_active')
                                ->default(true),
                        ])->columns(2),

                    // ── TAB 2: Nutrition Facts ──
                    Forms\Components\Tabs\Tab::make('Nutrition Facts')
                        ->schema([
                            Forms\Components\TextInput::make('serving_size')
                                ->placeholder('5gr'),

                            Forms\Components\TextInput::make('serving_per_container')
                                ->numeric()
                                ->placeholder('91'),

                            Forms\Components\TextInput::make('calories')
                                ->numeric(),

                            Forms\Components\TextInput::make('calories_from_fat')
                                ->numeric(),

                            Forms\Components\TextInput::make('total_fat')
                                ->numeric()->suffix('g'),

                            Forms\Components\TextInput::make('saturated_fat')
                                ->numeric()->suffix('g'),

                            Forms\Components\TextInput::make('trans_fat')
                                ->numeric()->suffix('g'),

                            Forms\Components\TextInput::make('cholesterol')
                                ->numeric()->suffix('mg'),

                            Forms\Components\TextInput::make('sodium')
                                ->numeric()->suffix('mg'),

                            Forms\Components\TextInput::make('total_carbohydrate')
                                ->numeric()->suffix('g'),

                            Forms\Components\TextInput::make('dietary_fiber')
                                ->numeric()->suffix('g'),

                            Forms\Components\TextInput::make('sugars')
                                ->numeric()->suffix('g'),

                            Forms\Components\TextInput::make('protein')
                                ->numeric()->suffix('g'),
                        ])->columns(2),

                    // ── TAB 3: Variants ──
                    Forms\Components\Tabs\Tab::make('Variants')
                        ->schema([
                            Forms\Components\Repeater::make('variants')
                                ->relationship()
                                ->schema([
                                    Forms\Components\TextInput::make('weight')
                                        ->required()
                                        ->placeholder('250gr'),

                                    Forms\Components\Select::make('packaging_type')
                                        ->options([
                                            'stick' => 'Stick (10gr)',
                                            'pouch' => 'Pouch (250gr)',
                                            'bag'   => 'Bag (1kg)',
                                        ])
                                        ->required(),

                                    Forms\Components\FileUpload::make('image')
                                        ->image()
                                        ->disk('public')
                                        ->directory('product-variants')
                                        ->maxSize(2048)
                                        ->columnSpanFull(),

                                    Forms\Components\Toggle::make('is_active')
                                        ->default(true),
                                ])->columns(2)
                                ->addActionLabel('+ Add Variant')
                                ->columnSpanFull(),
                        ]),

                ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')
                ->disk('public'),

            Tables\Columns\TextColumn::make('name')
                ->searchable()->sortable(),

            Tables\Columns\TextColumn::make('category')
                ->badge(),

            Tables\Columns\TextColumn::make('certifications')
                ->limit(30),

            Tables\Columns\IconColumn::make('is_active')
                ->boolean(),

            Tables\Columns\TextColumn::make('variants_count')
                ->counts('variants')
                ->label('Variants'),
        ])
        ->filters([
            Tables\Filters\TernaryFilter::make('is_active'),
        ])
        ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
