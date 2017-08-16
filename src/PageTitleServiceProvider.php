<?php

namespace Rephlux\PageTitle;

use Illuminate\Support\ServiceProvider;

/**
 * Class PageTitleServiceProvider.
 *
 * @author Chris van Daele <engine_no9@gmx.net>
 */
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
     */
    public function register()
    {
        $this->app->singleton('PageTitle', function () {
            $delimeter = config('pagetitle.delimiter');
            $page_name = config('pagetitle.page_name');
            $default   = config('pagetitle.default_title_when_empty');

            return new PageTitle($delimeter, $page_name, $default);
        });
    }

    public function boot()
    {
        $configPath = __DIR__.'/../config/config.php';

        $this->mergeConfigFrom($configPath, 'pagetitle');
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
