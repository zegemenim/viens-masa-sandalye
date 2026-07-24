<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);

        try {
            if (Schema::hasTable('site_settings')) {
                View::share('siteSettings', SiteSetting::all_settings());
            }
            if (Schema::hasTable('categories')) {
                View::share('navCategories', Category::orderBy('name')->get());
            }
        } catch (\Exception $e) {
            // Setup aşamasında (migrate edilmeden önce) view hatası fırlatmaması için
        }
    }
}
