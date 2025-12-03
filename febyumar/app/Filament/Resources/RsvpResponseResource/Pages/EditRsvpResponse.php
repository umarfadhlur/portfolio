<?php

namespace App\Filament\Resources\RsvpResponseResource\Pages;

use App\Filament\Resources\RsvpResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRsvpResponse extends EditRecord
{
    protected static string $resource = RsvpResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
