<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserPlanResource\Pages;
use App\Filament\Admin\Resources\UserPlanResource\RelationManagers;
use App\Models\Customer;
use App\Models\User;
use App\Models\UserPlan;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserPlanResource extends Resource
{
    protected static ?string $model = UserPlan::class;

    protected static ?string $navigationGroup = "Customer Management";
    protected static ?string $label = 'Customer Plan';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $modelLabel = 'Customer Plan';
    protected static ?string $navigationLabel = 'Customer Plans';
    protected static ?string $pluralLabel = 'Customer Plans';

    protected static ?string $pluralModelLabel = 'Customer Plans';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make()->columns(2)->schema([
                    Select::make('user_id')->label('Customer')->searchable()->options(User::customers()->pluck('name', 'id'))->required(),

                    Toggle::make('active')
                        ->label('Active')
                        ->inline(false)
                        ->default(true),

                    DatePicker::make('from_date')
                        ->label('From Date')->default(now())
                        ->required(),

                    DatePicker::make('to_date')->default(now()->addWeek())
                        ->label('To Date')
                        ->required(),
                    RichEditor::make('plan')
                        ->label('Plan Details')
                        ->required()->columnSpanFull()
                        ->maxLength(500),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('id', 'desc')
            ->striped()

            ->columns([
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('plan')
                    ->label('Plan Details')
                    ->limit(50)
                    ->sortable(),

                TextColumn::make('from_date')
                    ->label('From')
                    ->date()
                    ->sortable(),

                TextColumn::make('to_date')
                    ->label('To')
                    ->date()
                    ->sortable(),

                ToggleColumn::make('active')
                    ->label('Active')
                    ->sortable(),
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
            'index' => Pages\ListUserPlans::route('/'),
            'create' => Pages\CreateUserPlan::route('/create'),
            'edit' => Pages\EditUserPlan::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->count();
    }
}
