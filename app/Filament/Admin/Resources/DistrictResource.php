<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DistrictResource\Pages;
use App\Filament\Admin\Resources\DistrictResource\RelationManagers;
use App\Models\City;
use App\Models\District;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DistrictResource extends Resource
{
    protected static ?string $model = District::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?int $navigationSort = 3;  // Update the sorting as per your preference
    protected static ?string $navigationGroup = 'Countries & Cities Management';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make()->label('')->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('city_id')
                        ->label('City')
                        ->options(City::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->striped()
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->label('City')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDistricts::route('/'),
            'create' => Pages\CreateDistrict::route('/create'),
            'edit' => Pages\EditDistrict::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->count();
    }
}
