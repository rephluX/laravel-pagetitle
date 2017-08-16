<?php

namespace Rephlux\PageTitle;

use Countable;

/**
 * Class PageTitle.
 *
 * @author Chris van Daele <engine_no9@gmx.net>
 */
class PageTitle implements Countable
{
    /**
     * Collection of page title parts.
     *
     * @var array
     */
    protected $collection = [];

    /**
     * Delimeter string for seperate the page title parts.
     *
     * @var string
     */
    protected $delimeter;

    /**
     * The page name to append or prepend to the page title parts.
     *
     * @var string
     */
    protected $page_name;

    /**
     * The default text when no page title is set.
     *
     * @var string
     */
    protected $default;

    /**
     * @param string $delimeter
     * @param string $page_name
     * @param string $default
     */
    public function __construct($delimeter = ' | ', $page_name = '', $default = '')
    {
        $this->delimeter = $delimeter;
        $this->page_name = $page_name;
        $this->default   = $default;
    }

    /**
     * @return string
     */
    public function getDelimeter()
    {
        return $this->delimeter;
    }

    /**
     * @param string $delimeter
     *
     * @return $this
     */
    public function setDelimeter($delimeter)
    {
        $this->delimeter = $delimeter;

        return $this;
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        return $this->page_name;
    }

    /**
     * @param string $page_name
     *
     * @return $this
     */
    public function setPageName($page_name)
    {
        $this->page_name = $page_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param string $default
     *
     * @return $this
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Add an item to the collection.
     *
     * @param $item
     *
     * @return mixed
     */
    public function add($item)
    {
        if (is_array($item)) {
            return array_map([$this, 'add'], $item);
        }

        if (! $item | strlen(trim($item)) === 0) {
            return false;
        }

        $this->collection[] = trim(strip_tags($item));
    }

    /**
     * Count the collection.
     *
     * @return int
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
     * Get the page title.
     *
     * @param bool|string $direction
     *
     * @return string
     */
    public function get($direction = 'regular')
    {
        if ($this->count() == 0) {
            return $this->default;
        }

        if ($direction === 'downward') {
            $this->collection = array_reverse($this->collection);
        }

        $this->addPageName();

        if ($direction === 'reverse') {
            $this->collection = array_reverse($this->collection);
        }

        return implode($this->getDelimeter(), $this->collection);
    }

    /**
     * Add the page name to the collection.
     */
    protected function addPageName()
    {
        if (! empty($this->getPageName()) && ! in_array($this->getPageName(), $this->collection)) {
            $this->add($this->getPageName());
        }
    }
}
