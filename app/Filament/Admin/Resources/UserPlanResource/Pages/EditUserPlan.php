<?php

namespace App\Filament\Admin\Resources\UserPlanResource\Pages;

use App\Filament\Admin\Resources\UserPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserPlan extends EditRecord
{
    protected static string $resource = UserPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
