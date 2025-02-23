<?php

namespace App\Filament\Admin\Pages\Auth;

use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.admin.pages.auth.register';
}
