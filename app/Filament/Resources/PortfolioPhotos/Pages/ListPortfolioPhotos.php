<?php

namespace App\Filament\Resources\PortfolioPhotos\Pages;

use App\Filament\Resources\PortfolioPhotos\PortfolioPhotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioPhotos extends ListRecords
{
    protected static string $resource = PortfolioPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
