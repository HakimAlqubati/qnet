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
                                        ->unique(User::class, 'phonenumber')
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
                                        ->live()
                                        ->options(\App\Models\Country::pluck('name', 'id')) // ✅ Correct usage
                                        ->required(),

                                    Select::make('city_id')
                                        ->label('City')
                                        ->live()
                                        ->options(fn($get) => \App\Models\City::where('country_id', $get('country_id'))->pluck('name', 'id'))
                                        ->required(),

                                    Select::make('district_id')
                                        ->label('District')
                                        ->options(fn($get) => \App\Models\District::where('city_id', $get('city_id'))->pluck('name', 'id'))
                                ]),


                            Step::make('Profile Picture (Optional)')
                                ->schema([
                                    \Filament\Forms\Components\FileUpload::make('profile_photo_path')
                                        ->label('Upload Profile Picture')
                                        ->image()
                                        ->directory('profile-photos'),
                                ]),

                            // ✅ Added Fourth Step (Referral Information)
                            Step::make('Referral Information')
                                ->schema([
                                    TextInput::make('referral_number_1')
                                        ->label('Referral Number 1')
                                        ->numeric()
                                        ->nullable(),

                                    TextInput::make('referral_number_2')
                                        ->label('Referral Number 2')
                                        ->numeric()
                                        ->nullable(),

                                    Select::make('direction')
                                        ->label('Direction')
                                        ->options([
                                            'R' => 'Right',
                                            'L' => 'Left',
                                        ])
                                        ->required(),
                                ]),
                        ])->skippable()->columnSpanFull()
                    ])
                    ->statePath('data'),
            ),
        ];
    }


    protected function handleRegistration(array $data): User
    {
        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phonenumber' => $data['phonenumber'],
            'password' => Hash::make($data['password']), // Hash password
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
            'referral_number_1' => $data['referral_number_1'],
            'referral_number_2' => $data['referral_number_2'],
            'direction' => $data['direction'],
            'profile_photo_path' => $data['profile_photo_path'] ?? null, // Profile photo if uploaded
        ]);

        // Save user address in a separate table (UserAddress)
        if (!empty($data['address1']) || !empty($data['address2'])) {
            $user->address()->create([
                'address1' => $data['address1'],
                'address2' => $data['address2'] ?? null,
                'city_id' => $data['city_id'],
                'district_id' => $data['district_id'] ?? null,
            ]);
        }

        // Log in the new user
        auth()->login($user);

        // Redirect to dashboard
        return $user;
    }
    protected function redirectPath(): string
    {
        return route('dashboard'); // Change this to your desired route
    }
}
