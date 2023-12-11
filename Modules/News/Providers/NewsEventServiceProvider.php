<?php

namespace Modules\News\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\News\Entities\NewsCategory;
use Modules\News\Observers\NewsCategoryObserver;

class NewsEventServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        NewsCategory::observe(NewsCategoryObserver::class);
    }
}
