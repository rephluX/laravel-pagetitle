<?php

namespace Rephlux\PageTitle;

use Illuminate\Support\ServiceProvider;

class PageTitleServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('PageTitle', function ($app) {
            $delimeter = config('pagetitle.delimiter');
            $page_name = config('pagetitle.page_name');
            $default   = config('pagetitle.default_title_when_empty');

            return new PageTitle($delimeter, $page_name, $default);
        });
    }

    /**
     *
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../../config/config.php';
        $this->publishes([$configPath => config_path('pagetitle.php')], 'config');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['PageTitle'];
    }
}