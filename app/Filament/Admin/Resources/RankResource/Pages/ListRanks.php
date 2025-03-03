<?php

namespace App\Filament\Admin\Resources\RankResource\Pages;

use App\Filament\Admin\Resources\RankResource;
use App\Models\Rank;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;
class ListRanks extends ListRecords
{
    protected static string $resource = RankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

     

    /**
     * Apply Filters Based on Selected Tab
     */
    public function getTableFilters(): array
    {
        return [
            \Filament\Tables\Filters\SelectFilter::make('type')
                ->options([
                    'salary' => __('Salary'),
                    'team' => __('Team'),
                ])
                ->label(__('Rank Type'))
                ->default('salary') // Default filter
                ->hidden(fn ($livewire) => $livewire->activeTab !== 'all'), // Hide filter when using tabs
        ];
    }

     /**
     * Define tabs to filter ranks by type (Salary, Team).
     */
    public function getTabs(): array
    {
        // Define rank types
        $types = Rank::getRankTypes(); // Fetch types from Rank model

        return array_map(function ($label, $type) {
            return Tab::make($label)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', $type))
                ->icon(Rank::getTypeIcon($type)) // Custom icons per type
                ->badge(Rank::query()->where('type', $type)->count())
                ->badgeColor(Rank::getBadgeColor($type));
        }, $types, array_keys($types));
    }
}
