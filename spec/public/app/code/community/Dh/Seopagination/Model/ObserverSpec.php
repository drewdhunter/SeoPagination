<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Dh_Seopagination_Model_ObserverSpec extends ObjectBehavior
{
    function let(\Dh_Seopagination_Helper_Data $helper)
    {
        $this->beConstructedWith(array('_helper' => $helper));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dh_Seopagination_Model_Observer');
    }

    function it_should_not_do_anything_if_disabled(
        \Dh_Seopagination_Helper_Data $helper,
        \Dh_Seopagination_Model_PaginatorInterface $paginator)
    {
        $helper->isModuleEnabled()->willReturn(false);

        $paginator->paginate()->shouldNotBeCalled();
        $this->doPagination()->shouldBe(false);
    }

    function it_should_proceed_if_enabled(
        \Dh_Seopagination_Helper_Data $helper,
        \Dh_Seopagination_Model_PaginatorInterface $paginator)
    {
        $helper->isModuleEnabled()->willReturn(true);
        $helper->initPaginator()->shouldBeCalled();
        $helper->initPaginator()->willReturn($paginator);

        $paginator->paginate()->shouldBeCalled();
        $this->doPagination()->shouldBe($this);
    }

    function it_will_paginate_a_valid_paginator(
        \Dh_Seopagination_Helper_Data $helper,
        \Dh_Seopagination_Model_PaginatorInterface $paginator)
    {
        $helper->isModuleEnabled()->willReturn(true);
        $helper->initPaginator()->willReturn($paginator);

        $paginator->paginate()->shouldBeCalled();

        $this->doPagination();
    }

    function it_will_not_paginate_an_invalid_paginator(
        \Dh_Seopagination_Helper_Data $helper,
        \Dh_Seopagination_Model_PaginatorInterface $paginator)
    {
        $helper->isModuleEnabled()->willReturn(true);
        $helper->initPaginator()->willReturn(null);

        $paginator->paginate()->shouldNotBeCalled();

        $this->doPagination();
    }
}
