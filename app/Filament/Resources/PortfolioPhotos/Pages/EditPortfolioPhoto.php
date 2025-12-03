<?php

namespace App\Filament\Resources\PortfolioPhotos\Pages;

use App\Filament\Resources\PortfolioPhotos\PortfolioPhotoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioPhoto extends EditRecord
{
    protected static string $resource = PortfolioPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
