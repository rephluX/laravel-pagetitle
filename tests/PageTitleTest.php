<?php

use Rephlux\PageTitle\PageTitle;

class PageTitleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PageTitle
     */
    protected $pageTitle;

    /**
     * Setup the testcase.
     */
    public function setUp()
    {
        parent::setUp();

        $this->pageTitle = new PageTitle(' | ', 'My Homepage', 'Welcome on my Homepage');
    }

    /** @test */
    public function it_can_add_a_title()
    {
        $this->pageTitle->add('Page Title');

        $this->assertCount(1, $this->pageTitle);
        $this->assertEquals('Page Title | My Homepage', $this->pageTitle->get());
    }

    /** @test */
    public function it_can_accept_an_array_as_a_page_title()
    {
        $this->pageTitle->add(['Page Title 1', 'Page Title 2']);

        $this->assertCount(2, $this->pageTitle);
        $this->assertEquals('Page Title 1 | Page Title 2 | My Homepage', $this->pageTitle->get());
    }

    /** @test */
    public function it_cant_accept_an_empty_string()
    {
        $this->pageTitle->add('');

        $this->assertCount(0, $this->pageTitle);
    }

    /** @test */
    function it_displays_the_default_page_title_when_no_page_title_parts_are_set()
    {
        $this->assertEquals('Welcome on my Homepage', $this->pageTitle->get());
    }

    /** @test */
    function it_displays_the_page_title_once_when_called_multiple_times()
    {
        $this->pageTitle->add('Page Title');

        $this->pageTitle->get();
        $this->assertEquals('Page Title | My Homepage', $this->pageTitle->get());
    }

    /** @test */
    function it_displays_page_title_in_reverse_order()
    {
        $this->pageTitle->add(['Page Title 1', 'Page Title 2']);

        $this->assertEquals('My Homepage | Page Title 2 | Page Title 1', $this->pageTitle->get('reverse'));
    }

    /** @test */
    function it_displays_page_title_in_downward_order()
    {
        $this->pageTitle->add(['Page Title 1', 'Page Title 2']);

        $this->assertEquals('Page Title 2 | Page Title 1 | My Homepage', $this->pageTitle->get('downward'));
    }
}
