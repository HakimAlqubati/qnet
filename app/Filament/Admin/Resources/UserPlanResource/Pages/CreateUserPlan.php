<?php

namespace App\Filament\Admin\Resources\UserPlanResource\Pages;

use App\Filament\Admin\Resources\UserPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserPlan extends CreateRecord
{
    protected static string $resource = UserPlanResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
