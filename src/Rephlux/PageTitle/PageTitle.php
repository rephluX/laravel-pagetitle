<?php namespace Rephlux\PageTitle;

use Countable;

class PageTitle implements Countable
{
    /**
     * Collection of page title parts
     *
     * @var array
     */
    protected $collection = [];

    /**
     * Delimeter string for seperate the page title parts
     *
     * @var string
     */
    private $delimeter;

    /**
     * The page name to append or prepend to the page title parts
     *
     * @var string
     */
    private $page_name;

    /**
     * The default text when no page title is set
     *
     * @var string
     */
    private $default;

    /**
     * The generated title
     *
     * @var string
     */
    private $title;

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
     * Add an item to the collection
     *
     * @param $item
     * @return mixed
     */
    public function add($item)
    {
        if (is_array($item)) {
            return array_map([$this, 'add'], $item);
        }
        if (!$item | strlen(trim($item)) === 0) {
            return false;
        }
        $this->collection[] = trim(strip_tags($item));
    }

    /**
     * Count the collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
     * Get the page title
     *
     * @param bool|string $direction
     * @return string
     */
    public function get($direction = 'regular')
    {
        if (strlen($this->title)) {
            return $this->title;
        }

        if ($this->count() == 0) {
            return $this->default;
        }

        if (isset($this->page_name)) {
            $this->add($this->page_name);
        }

        $combined = implode(
            $this->delimeter,
            $direction === 'reverse' ? array_reverse($this->collection) : $this->collection
        );

        $this->title = $combined;

        return $this->title;
    }
}
