<?php

namespace App\Providers;

use App\Models\Fundraisers;
use App\Models\Fundraising;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Observers\FundraisingObserver;
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
         Fundraising::observe(FundraisingObserver::class);
    }
}
