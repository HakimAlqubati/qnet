<?php

namespace App\Filament\Admin\Pages\Auth;

use Livewire\Component;
use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseRegister;
use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\View;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Pages\BasePage;
use Illuminate\Support\Facades\Password;

// use Filament\Resources\Pages\Page;

class Register extends BaseRegister
{

    protected function getLayoutData(): array
    {
        return [
            'hasTopbar' => $this->hasTopbar(),
            'maxWidth' => $this->getMaxWidth(),
        ];
    }


    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        Wizard::make([
                            Step::make('Personal Information')
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Full Name')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('email')
                                        ->label('Email Address')
                                        ->email()
                                        ->unique(User::class, 'email')
                                        ->required(),
                                    TextInput::make('phonenumber')
                                        ->label('Phone number')
                                        ->email()
                                        ->unique(User::class, 'email')
                                        ->required(),
                                    TextInput::make('password')
                                        ->label('Password')
                                        ->password()
                                        ->required()
                                        ->minLength(8),

                                    TextInput::make('password_confirmation')
                                        ->label('Confirm Password')
                                        ->password()
                                        ->same('password')
                                        ->required(),
                                ]),

                            Step::make('Address Information') // New Address Step
                                ->schema([
                                    TextInput::make('address1')
                                        ->label('Address Line 1')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('address2')
                                        ->label('Address Line 2')
                                        ->maxLength(255),

                                    Select::make('country_id')
                                        ->label('Country')
                                        // ->relationship('country', 'name')
                                        ->required(),

                                    Select::make('city_id')
                                        ->label('City')
                                        // ->relationship('city', 'name')
                                        ->required(),

                                    Select::make('district_id')
                                        ->label('District')
                                        // ->relationship('district', 'name'),
                                ]),


                            Step::make('Profile Picture (Optional)')
                                ->schema([
                                    \Filament\Forms\Components\FileUpload::make('profile_photo')
                                        ->label('Upload Profile Picture')
                                        ->image()
                                        ->directory('profile-photos'),
                                ]),
                        ])->skippable()->columnSpanFull()
                    ])
                    ->statePath('data'),
            ),
        ];
    }


    protected function handleRegistration(array $data): User
    {

        dd('d');
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password']),
        // ]);
    }
}
