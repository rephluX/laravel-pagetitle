<?php namespace Rephlux\PageTitle;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class PageTitleServiceProvider extends ServiceProvider {

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
        $this->app->bind('PageTitle', function($app) {
            $delimeter = Config::get('pagetitle::config.delimiter');
            $page_name = Config::get('pagetitle::config.page_name');
            $default   = Config::get('pagetitle::config.default_title_when_empty');

            return new PageTitle($delimeter, $page_name, $default);
        });
	}

    public function boot()
    {
        $this->package('rephlux/pagetitle');

        AliasLoader::getInstance()->alias(
            'PageTitle',
            'Rephlux\PageTitle\Facades\PageTitle'
        );
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
