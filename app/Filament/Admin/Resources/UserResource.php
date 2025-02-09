<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\BVHistory;
use App\Models\User;

use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = "User Management";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\Select::make('roles')
                            ->label(__('Role'))
                            ->relationship('roles', 'name')
                            ->preload()
                            ->native(false)
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->prefixIcon('heroicon-m-envelope')->prefixIconColor(Color::Orange)
                            ->maxLength(191),
                        Forms\Components\TextInput::make('phonenumber')
                            ->minLength(9)
                            ->prefixIcon('heroicon-m-phone')->prefixIconColor(Color::Orange)
                            ->required()
                            ->maxLength(12),
                        Forms\Components\FileUpload::make('profile_photo_path')
                            ->image()->columnSpanFull()
                            ->label("Image"),
                        Grid::make()->columns(2)->schema([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = static::getModel()::query();

        $query->admins();
        return $query;
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->admins()->count();
    }
}
