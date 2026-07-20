<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

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
        Paginator::useBootstrapFive();
        
        View::composer('admin-main.layouts.default', function ($view) {

            if (Auth::check()) {
                $companyDetails = Company::with('companySetting')->where('id', Auth::user()->company_id)->first();
                $view->with('companyDetails', $companyDetails);
            } else {
                $view->with('companyDetails', null);
            }

        });
    }
}
