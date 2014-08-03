<?php namespace Rephlux\PageTitle\Facades;

use Illuminate\Support\Facades\Facade;

class PageTitle extends Facade {

    /**
     * Name of the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'PageTitle';
    }

} 