<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\ISplitGISIDRepository;
use App\Repositories\SplitGISIDRepository;
use App\Services\SplitGISIDService;
use App\Repositories\IMergeGISIDRepository;
use App\Repositories\MergeGISIDRepository;
use App\Services\MergeGISIDService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ISplitGISIDRepository::class, SplitGISIDRepository::class);
        $this->app->bind(SplitGISIDService::class, SplitGISIDService::class);
        $this->app->bind(IMergeGISIDRepository::class, MergeGISIDRepository::class);
        $this->app->bind(MergeGISIDService::class, MergeGISIDService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') === 'local') {
        \URL::forceScheme('https');
        }
    }
}
