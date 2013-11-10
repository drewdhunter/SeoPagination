<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class Dh_Seopagination_Model_PaginatorSpec extends ObjectBehavior
{
    /**#@+
     * Link constants
     */
    const PREVIOUS_LINK = 'blah-prev';
    const NEXT_LINK = 'blah-next';
    /**#@-*/

    /**
     * @param \Mage_Page_Block_Html_Head $headBlock
     * @param \Mage_Page_Block_Html_Pager $pagerBlock
     */
    function let(\Mage_Page_Block_Html_Head $headBlock, \Mage_Page_Block_Html_Pager $pagerBlock)
    {
        $pagerBlock->getNextPageUrl()->willReturn(self::NEXT_LINK);
        $pagerBlock->getPreviousPageUrl()->willReturn(self::PREVIOUS_LINK);

        $this->beConstructedWith(
            array(
                'headBlock' => $headBlock,
                'pagerBlock' => $pagerBlock
            )
        );
    }

    function it_should_have_correct_head_block()
    {
        $this->getHeadBlock()->beAnInstanceOf('Mage_Page_Block_Html_Head');
    }

    function it_should_have_correct_pager_block()
    {
        $this->getHeadBlock()->beAnInstanceOf('Mage_Page_Block_Html_Pager');
    }

    function it_will_not_add_any_links_to_empty_page_collections(
        \Mage_Page_Block_Html_Pager $pagerBlock)
    {
        $pagerBlock->getTotalNum()->willReturn(0);
        $this->paginate();
    }

    function it_will_not_add_any_links_to_single_page_collections(
        \Mage_Page_Block_Html_Pager $pagerBlock)
    {
        $pagerBlock->getTotalNum()->willReturn(1);
        $this->paginate();
    }

    function it_only_creates_a_next_link_if_current_page_is_first_and_there_are_multiple_pages(
        \Mage_Page_Block_Html_Head $headBlock,
        \Mage_Page_Block_Html_Pager $pagerBlock)
    {
        $pagerBlock->isFirstPage()->willReturn(true);
        $pagerBlock->isLastPage()->willReturn(false);
        $pagerBlock->getTotalNum()->willReturn(2);

        $headBlock->addLinkRel('next', self::NEXT_LINK)->shouldBeCalled();

        $this->paginate();
    }

    function it_only_creates_a_prev_link_if_current_page_is_last_and_there_are_multiple_pages(
      \Mage_Page_Block_Html_Head $headBlock,
        \Mage_Page_Block_Html_Pager $pagerBlock)
    {
        $pagerBlock->isFirstPage()->willReturn(false);
        $pagerBlock->isLastPage()->willReturn(true);
        $pagerBlock->getTotalNum()->willReturn(2);

        $headBlock->addLinkRel('prev', self::PREVIOUS_LINK)->shouldBeCalled();

        $this->paginate();
    }

    function it_will_add_both_next_and_previous_links_when_there_are_more_than_two_pages_and_current_page_is_not_first_or_last(
        \Mage_Page_Block_Html_Head $headBlock,
        \Mage_Page_Block_Html_Pager $pagerBlock)
    {
        $pagerBlock->isFirstPage()->willReturn(false);
        $pagerBlock->isLastPage()->willReturn(false);
        $pagerBlock->getTotalNum()->willReturn(3);

        $headBlock->addLinkRel('prev', self::PREVIOUS_LINK)->shouldBeCalled();
        $headBlock->addLinkRel('next', self::NEXT_LINK)->shouldBeCalled();

        $this->paginate();
    }
}
