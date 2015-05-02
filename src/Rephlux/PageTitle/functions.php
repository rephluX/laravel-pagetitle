<?php

if (!function_exists('pagetitle'))
{
    /**
     * PageTitle helper method.
     *
     * @param string|null $title
     * @return \Rephlux\PageTitle\PageTitle
     */
    function pagetitle($title = null)
    {
        $pagetitle = app('PageTitle');

        if (!is_null($title))
        {
            $pagetitle->add($title);
        }

        return $pagetitle;
    }
}