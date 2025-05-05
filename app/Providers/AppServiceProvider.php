<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;

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
        // Ensure the correct namespace is used or remove this line if unnecessary
        // Example: Uncomment the following line if the correct namespace is \Maatwebsite\Excel\ExcelServiceProvider
        // \Maatwebsite\Excel\ExcelServiceProvider::class;
        Paginator::useBootstrap();

    }
}
