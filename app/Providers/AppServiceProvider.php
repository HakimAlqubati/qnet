<?php

namespace App\Providers;

use App\Filament\Admin\Pages\Auth\Register;
use Filament\Facades\Filament;
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
        Schema::defaultStringLength(191);
    }
}
