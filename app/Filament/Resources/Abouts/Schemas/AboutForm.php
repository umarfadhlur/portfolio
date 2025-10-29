<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\FileUpload\TemporaryUploadedFile;

class AboutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('introduction')
                    ->required(),
                Textarea::make('summary')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('pdf')
                    ->label('Resume PDF')
                    ->disk('public')
                    ->directory('about')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(2048)
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $slug = Str::slug($originalName);
                        $ext = $file->getClientOriginalExtension();

                        return $slug . '.' . $ext;
                    })
                    ->nullable(),
                // ->preserveFilenames(false)
                // ->getUploadedFileNameForStorageUsing(
                //     function (TemporaryUploadedFile $file, $get): string {
                //         $raw = $get('introduction')
                //             ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                //         $slug = Str::slug($raw) ?: 'file';

                //         return strtolower($slug . '.' . $file->getClientOriginalExtension());
                //     }
                // )
            ]);
    }
}
