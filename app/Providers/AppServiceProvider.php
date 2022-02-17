<?php

namespace App\Providers;

use App\Support\Sitemap;
use Danshin\Sitemap\Services\SitemapUrlContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SitemapUrlContract::class, function () {
            return new Sitemap();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
