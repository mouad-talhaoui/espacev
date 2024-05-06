<?php

namespace App\Providers;

use App\Http\Controllers\ClassMenu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        //Paginator::useBootstrapFive();
        $views=[
            'etudiant.confirmation',
            'etudiant.convocation',
            'etudiant.index',
            'etudiant.dashboard',
            'etudiant.ip',
        ];

        view()->composer($views,ClassMenu::class);
        Schema::defaultStringLength(191);
    }
}
