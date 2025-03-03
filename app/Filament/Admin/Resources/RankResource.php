<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RankResource\Pages;
use App\Models\Rank;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RankResource extends Resource
{
    protected static ?string $model = Rank::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'Rank Management';
    protected static ?string $label = 'Rank';

    protected static ?string $modelLabel = 'Rank';
    protected static ?string $navigationLabel = 'Ranks';
    protected static ?string $pluralLabel = 'Ranks';

    protected static ?string $pluralModelLabel = 'Ranks';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make()->columns(4)->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Rank Name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('level')
                        ->label('Level')
                        ->numeric()
                        ->minValue(1)
                        ->required(),

                    Forms\Components\TextInput::make('minimum_points')
                        ->label('Minimum Points')
                        ->numeric()
                        ->minValue(0)
                        ->required(),

                    ToggleButtons::make('type')->columns(2)->options(
                        Rank::getRankTypes()

                    )->label('Type')
                        ->default(Rank::TYPE_SALARY)
                        ->required(),

                    Forms\Components\Textarea::make('benefits')
                        ->label('Benefits')->columnSpanFull()
                        ->placeholder('Describe benefits or add JSON-formatted benefits')
                        ->rows(4),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->striped()
            ->columns([
                TextColumn::make('name')->label('Rank Name')->sortable()->searchable(),
                TextColumn::make('level')->sortable()->label('Level'),
                TextColumn::make('minimum_points')->sortable()->label('Minimum Points'),
                TextColumn::make('benefits')
                    ->limit(50)
                    ->label('Benefits'),
                TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any related models if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRanks::route('/'),
            'create' => Pages\CreateRank::route('/create'),
            'edit' => Pages\EditRank::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->count();
    }
}
