<?php

namespace App\Filament\Resources\PortfolioPhotos\Pages;

use App\Filament\Resources\PortfolioPhotos\PortfolioPhotoResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioPhoto extends CreateRecord
{
    protected static string $resource = PortfolioPhotoResource::class;
}
