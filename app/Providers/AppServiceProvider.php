<?php

namespace App\Providers;

use App\Filament\Admin\Pages\Auth\Register;
use Filament\Facades\Filament;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Filament::registerPages([
        //     Register::class, // Ensure your custom page is registered
        // ]);
        FilamentAsset::register([
            // Css::make('main', ''),
        ]);
        Schema::defaultStringLength(191);
    }
}
