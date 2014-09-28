<?php namespace spec\Rephlux\Pagetitle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PageTitleSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith(' | ', 'My Homepage', 'Welcome on my Homepage');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Rephlux\Pagetitle\PageTitle');
    }

    function it_adds_a_string_to_the_collection()
    {
        $this->add('Page Title');

        $this->shouldHaveCount(1);
    }

    function it_can_accept_an_array_as_a_page_title()
    {
        $this->add(['Page Title 1', 'Page Title 2']);

        $this->shouldHaveCount(2);
    }

    function it_cant_accept_an_empty_string()
    {
        $this->add('');

        $this->shouldHaveCount(0);
    }

    function it_displays_the_default_page_title_when_no_page_title_parts_are_set()
    {
        $this->get()->shouldReturn('Welcome on my Homepage');
    }

    function it_displays_page_title_when_one_page_title_part_is_set()
    {
        $this->add('Page Title');

        $this->get()->shouldReturn('Page Title | My Homepage');
    }

    function it_displays_page_title_when_multiple_page_title_parts_are_set()
    {
        $this->add(['Page Title 1', 'Page Title 2']);

        $this->get()->shouldReturn('Page Title 1 | Page Title 2 | My Homepage');
    }

    function it_displays_page_title_in_reverse_order()
    {
        $this->add(['Page Title 1', 'Page Title 2']);

        $this->get('reverse')->shouldReturn('My Homepage | Page Title 2 | Page Title 1');
    }

    function it_displays_the_page_title_once_when_called_multiple_times()
    {
        $this->add('Page Title');

        $this->get();
        $this->get()->shouldReturn('Page Title | My Homepage');
    }
}
