<?php

namespace App\Filament\Resources\InvitationSettingResource\Pages;

use App\Filament\Resources\InvitationSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvitationSetting extends EditRecord
{
    protected static string $resource = InvitationSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
