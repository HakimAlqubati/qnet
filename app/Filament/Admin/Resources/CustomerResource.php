<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CustomerResource\Pages\CreateCustomer;
use App\Filament\Admin\Resources\CustomerResource\Pages\EditCustomer;
use App\Filament\Admin\Resources\CustomerResource\Pages\ListCustomers;
use App\Filament\Admin\Resources\CustomerResource\RelationManagers\BvHistoryRelationManager;
use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\BVHistory;
use App\Models\Rank;
use App\Models\User;
use App\Models\UserAccountHistory;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = "Customer Management";
    protected static ?string $label = 'Customer';

    protected static ?string $modelLabel = 'Customer';
    protected static ?string $navigationLabel = 'Customers';
    protected static ?string $pluralLabel = 'Customers';

    protected static ?string $pluralModelLabel = 'Customers';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(191),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->prefixIcon('heroicon-m-envelope')->prefixIconColor(Color::Orange)
                            ->maxLength(191),
                        Forms\Components\TextInput::make('phonenumber')
                            ->minLength(9)
                            ->prefixIcon('heroicon-m-phone')->prefixIconColor(Color::Orange)
                            ->required()->unique(ignoreRecord: true)
                            ->maxLength(12),
                        Forms\Components\FileUpload::make('profile_photo_path')
                            ->image()->columnSpanFull()
                            ->label("Image"),
                        Grid::make()->columns(4)->schema([
                            Select::make('country_id')
                                ->label('Country')
                                ->relationship('country', 'name')
                                ->searchable()
                                ->placeholder('Select Country'),

                            Select::make('city_id')
                                ->label('City')
                                ->relationship('city', 'name')
                                ->searchable()
                                ->placeholder('Select City'),

                            Select::make('rank_id')
                                ->label('Salary Rank')
                                ->options(
                                    Rank::query()
                                        ->where('type', 'salary')
                                        ->pluck('name', 'id')
                                )
                                ->placeholder('Select')
                                ->preload(),

                            Select::make('rank_team_id')
                                ->label('Team Rank')
                                ->options(
                                    Rank::query()
                                        ->where('type', Rank::TYPE_TEAM)
                                        ->pluck('name', 'id')
                                )
                                ->placeholder('Select')
                                ->preload(),
                        ]),

                        Grid::make()->columns(2)->hidden()->schema([
                            TextInput::make('password')
                                ->password()
                                ->prefixIcon('heroicon-m-lock-closed')->prefixIconColor(Color::Orange)
                                ->required(fn(string $context) => $context === 'create')
                                ->reactive()
                                ->dehydrateStateUsing(fn($state) => Hash::make($state)),
                            TextInput::make('password_confirmation')
                                ->password()
                                ->prefixIcon('heroicon-m-check')->prefixIconColor(Color::Orange)
                                ->required(fn(string $context) => $context === 'create')
                                ->same('password')
                                ->label('Confirm Password'),
                        ]),
                        Grid::make()->columns(2)->schema([
                            TextInput::make('identify_id')
                                ->prefixIcon('heroicon-m-lock-closed')
                                ->prefixIconColor(Color::Orange)
                                ->label('ID'),
                            TextInput::make('code_q')

                                ->prefixIcon('heroicon-m-check')->prefixIconColor(Color::Orange)
                                ->label('Q Code'),
                        ]),


                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->striped()
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('profile_photo_path')
                    ->label(""),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')->icon('heroicon-m-envelope')->copyable()
                    ->sortable()->searchable()->limit(20)->default('@')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(isIndividual: false, isGlobal: true)
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->color('primary')
                    ->weight(FontWeight::Bold),
                TextColumn::make('phonenumber')->label('Phone')->searchable()->icon('heroicon-m-phone')->searchable(isIndividual: false)->default('_')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->copyable()
                    ->copyMessage('Phone number copied')
                    ->copyMessageDuration(1500)
                    ->color('primary')
                    ->weight(FontWeight::Bold),
                TextColumn::make('childrenCount')->label('Persons Under')->toggleable()->alignCenter(true),
                // TextColumn::make('currentRightBV')->label('Right BV')
                //     ->toggleable()->alignCenter(true),
                TextColumn::make('current_balance')->label('Dollor Account')
                    ->toggleable()->alignCenter(true),
                TextColumn::make('currentRSP')->label('Current RSP')->toggleable()->alignCenter(true),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([

                Tables\Actions\Action::make('addBVHistory')
                    ->label('Add BV')
                    ->form([
                        Fieldset::make()->columns(2)->schema([
                            Fieldset::make()->columnSpan(2)->schema([
                                ToggleButtons::make('direction')->options(BVHistory::getDirectionLabels())->required()->columns(2),
                            ]),
                            Forms\Components\TextInput::make('bv_value')
                                ->label('BV Value')->columnSpanFull()
                                ->numeric()
                                ->required(),
                            Forms\Components\Textarea::make('description')
                                ->label('Description')->columnSpanFull()
                                ->maxLength(255),
                        ])
                    ])
                    ->action(function (array $data, User $record) {
                        $record->bvHistory()->create([
                            'direction' => $data['direction'],
                            'bv_value' => $data['bv_value'],
                            'description' => $data['description'] ?? '',
                        ]);
                    })
                    ->icon('heroicon-o-plus')->button()->color(Color::Orange),

                Tables\Actions\Action::make('addRspHistory')
                    ->label('Add RSP')
                    ->form([
                        Fieldset::make()->columns(2)->schema([

                            Forms\Components\TextInput::make('rsp_value')
                                ->label('RSP Value')->columnSpanFull()
                                ->numeric()
                                ->required(),
                            Forms\Components\Textarea::make('description')
                                ->label('Description')->columnSpanFull()
                                ->maxLength(255),
                        ])
                    ])
                    ->action(function (array $data, User $record) {
                        $record->rspHistory()->create([
                            'rsp_value' => $data['rsp_value'],
                            'description' => $data['description'] ?? '',
                        ]);
                    })
                    ->icon('heroicon-o-plus')->button()->color(Color::Blue),

                Tables\Actions\Action::make('addAccountHistory')
                    ->label('Add Account Transaction')
                    ->form([
                        Fieldset::make()->columns(2)->schema([
                            Forms\Components\TextInput::make('amount')
                                ->label('Amount')
                                ->numeric()
                                ->required(),
                            ToggleButtons::make('type')->options(UserAccountHistory::getTypeLabels())
                                ->columns(2)->default(UserAccountHistory::TYPE_INCREASE)
                                ->icons([
                                    'heroicon-o-plus' => UserAccountHistory::TYPE_INCREASE,
                                    'heroicon-o-minus' => UserAccountHistory::TYPE_DECREASE,
                                ]),
                            Forms\Components\Textarea::make('notes')
                                ->label('Notes')
                                ->columnSpanFull()
                                ->maxLength(255),
                        ])
                    ])
                    ->action(function (array $data, User $record) {
                        $record->accountHistory()->create([
                            'amount' => $data['amount'],
                            'type' => $data['type'],
                            'notes' => $data['notes']
                        ]);

                        Notification::make()
                            ->title('Account Transaction Added')
                            ->success()
                            ->send();
                    })
                    ->icon('heroicon-o-currency-dollar')
                    ->button()
                    ->color(Color::Emerald),
                Tables\Actions\Action::make('addChild')
                    ->label('Add Person Under')
                    ->form([
                        Fieldset::make()->columns(4)->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(191),

                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->required()
                                ->prefixIcon('heroicon-m-envelope')->prefixIconColor(Color::Orange)
                                ->maxLength(191),
                            Forms\Components\TextInput::make('phonenumber')
                                ->minLength(9)
                                ->prefixIcon('heroicon-m-phone')->prefixIconColor(Color::Orange)
                                ->required()->unique(ignoreRecord: true)
                                ->maxLength(12),
                            ToggleButtons::make('type')->columns(2)->options(
                                User::getDirectionLabels()

                            )->label('Type')
                                ->default(User::DIRECTION_RIGHT)
                                ->required(),
                            Forms\Components\FileUpload::make('profile_photo_path')
                                ->image()->columnSpanFull()
                                ->label("Image"),
                            Grid::make()->columns(4)->schema([
                                Select::make('country_id')
                                    ->label('Country')
                                    ->relationship('country', 'name')
                                    ->searchable()
                                    ->placeholder('Select Country'),

                                Select::make('city_id')
                                    ->label('City')
                                    ->relationship('city', 'name')
                                    ->searchable()
                                    ->placeholder('Select City'),


                            ])
                        ])

                    ])
                    ->action(function (array $data, User $record) {

                        // Create the child user
                        User::create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'phonenumber' => $data['phonenumber'],
                            'password' => Hash::make('123456'),
                            'parent_id' => $record->id,
                            'user_type' => User::USER_TYPE_CUSTOMER,
                        ]);


                        Notification::make()->title('Done')
                            ->body('Child user added successfully under ' . $record->name)
                            ->success()->send();
                    })
                    ->icon('heroicon-o-plus')
                    ->button()
                    ->color(Color::Green),

                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            BvHistoryRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomers::route('/'),
            'create' => CreateCustomer::route('/create'),
            'edit' => EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query();

        $query->customers();
        return $query;
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->customers()->count();
    }
}
