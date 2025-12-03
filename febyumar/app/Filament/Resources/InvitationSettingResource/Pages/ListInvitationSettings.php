<?php

namespace App\Filament\Resources\InvitationSettingResource\Pages;

use App\Filament\Resources\InvitationSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvitationSettings extends ListRecords
{
    protected static string $resource = InvitationSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
