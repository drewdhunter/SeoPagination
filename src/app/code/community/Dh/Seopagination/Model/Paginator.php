<?php

/**
 * This file is part of the Dh_Seopagination module for Magento.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 5.3
 *
 * @category  Dh
 * @package   Dh_Seopagination
 * @author    Drew Hunter <drewdhunter@gmail.com>
 * @copyright 2013 Drew Hunter
 * @license   http://opensource.org/licenses/MIT MIT License (MIT)
 * @link      https://github.com/drewhunter/SeoPagination
 */

/**
 * Paginator injects seo pagination links when/where applicable
 * into the head element on category pages.
 *
 * @category  Dh
 * @package   Dh_Seopagination
 * @author    Drew Hunter <drewdhunter@gmail.com>
 * @copyright 2013 Drew Hunter
 * @license   http://opensource.org/licenses/MIT MIT License (MIT)
 * @link      https://github.com/drewhunter/SeoPagination
 */
class Dh_Seopagination_Model_Paginator implements Dh_Seopagination_Model_PaginatorInterface
{
    /**
     * @var Mage_Page_Block_Html_Head
     */
    private $_headBlock;

    /**
     * @var Mage_Page_Block_Html_Pager
     */
    private $_pagerBlock;

    /**
     * Set the required services
     *
     * @param array $services required services
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $services = array())
    {
        if (! isset($services['headBlock'])) {
            throw new InvalidArgumentException(
                'Instance of Mage_Page_Block_Html_Head required');
        }

        if (! isset($services['pagerBlock'])) {
            throw new InvalidArgumentException(
                'Instance of Mage_Page_Block_Html_Pager required');
        }

        $this->_setHeadBlock($services['headBlock']);
        $this->_setPagerBlock($services['pagerBlock']);
    }

    /**
     * Set the head block
     *   - used to set prev/next links on
     *
     * @param Mage_Page_Block_Html_Head $headBlock magento head block instance
     *
     * @return null
     */
    private function _setHeadBlock(Mage_Page_Block_Html_Head $headBlock)
    {
        $this->_headBlock = $headBlock;
    }

    /**
     * Set the pager block
     *   - used to retrieve the previous and next urls
     *
     * @param Mage_Page_Block_Html_Pager $pagerBlock magento pager block instance
     *
     * @return null
     */
    private function _setPagerBlock(Mage_Page_Block_Html_Pager $pagerBlock)
    {
        $this->_pagerBlock = $pagerBlock;
    }

    /**
     * @return Mage_Page_Block_Html_Head
     */
    public function getHeadBlock()
    {
        return $this->_headBlock;
    }

    /**
     * @return Mage_Page_Block_Html_Pager
     */
    public function getPagerBlock()
    {
        return $this->_pagerBlock;
    }

    /**
     * If more than 1 page exists in the collection then attempt to add a next
     * and prev link.
     *
     * @return null
     */
    public function paginate()
    {
        if ($this->_pagerBlock->getTotalNum() > 1) {
            $this->_addPrevLink();
            $this->_addNextLink();
        }
    }

    /**
     * Attempt to add a prev link - this will only be possible if we are not on
     * the first page.
     *
     * @return bool
     */
    private function _addPrevLink()
    {
        if (! $this->_pagerBlock->isFirstPage()) {
            $this->_headBlock
                ->addLinkRel('prev', $this->_pagerBlock->getPreviousPageUrl());
            return true;
        }

        return false;
    }

    /**
     * Attempt to add a next link - this will only be possible
     * if we are not on the last page.
     *
     * @return bool
     */
    private function _addNextLink()
    {
        if (! $this->_pagerBlock->isLastPage()) {
            $this->_headBlock
                ->addLinkRel('next', $this->_pagerBlock->getNextPageUrl());
            return true;
        }

        return false;
    }
}
