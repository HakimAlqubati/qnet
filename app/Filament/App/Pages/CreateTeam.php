<?php

namespace App\Filament\App\Pages;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateTeam extends RegisterTenant
{
    protected static string $view = 'filament.pages.create-team';

    public $name = '';



    protected ?string $maxWidth = '2xl';

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Team Name')
                ->required()
                ->maxLength(255),
        ];
    }

    protected function handleRegistration(array $data): Model
    {
        return app(\App\Actions\Jetstream\CreateTeam::class)->create(auth()->user(), $data);
    }

    public function getBreadcrumbs(): array
    {
        return [
            url()->current() => 'Create Team',
        ];
    }

    public static function getLabel(): string
    {
        return 'Create Store';
    }
}
