<?php

class Dh_SeoPagination_Model_Paginator extends Mage_Core_Model_Abstract
{
    /**
     * @var int
     */
    private $memoizedLimit;

    /**
     * @var Mage_Page_Block_Html_Pager
     */
    private $memoizedPager;

    /**
     * @return Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection
     */
    private function getProductCollectionBasedOnCurrentCategoryAndLayer()
    {
        /** @var Mage_Catalog_Model_Layer $layer */
        $layer = Mage::getSingleton('catalog/layer');
        $productCollection = $layer->getProductCollection();
        $productCollection->setPageSize($this->getLimit());

        return $productCollection;
    }

    /**
     * @return Mage_Catalog_Block_Product_List_Toolbar
     */
    private function getProductListingToolbarBlock()
    {
        return Mage::app()->getLayout()->createBlock('catalog/product_list_toolbar');
    }

    /**
     * @return int
     */
    private function getLimit()
    {
        if (null === $this->memoizedLimit) {
            $this->memoizedLimit = (int) $this->getProductListingToolbarBlock()->getLimit();
        }

        return $this->memoizedLimit;
    }

    /**
     * @return Mage_Page_Block_Html_Pager
     */
    private function getPager()
    {
        if (null === $this->memoizedPager) {
            $productCollection = $this->getProductCollectionBasedOnCurrentCategoryAndLayer();
            $this->memoizedPager = Mage::app()->getLayout()->createBlock('page/html_pager');
            $this->memoizedPager->setLimit($this->getLimit())->setCollection($productCollection);
        }

        return $this->memoizedPager;
    }

    /**
     * @return string
     */
    private function getPreviousPageUrl()
    {
        $pager = $this->getPager();

        if ($pager->getCurrentPage() > 2) {
            return $pager->getPreviousPageUrl();
        }

        return $this->getFirstPageUrl();
    }

    /**
     * @return string
     */
    private function getFirstPageUrl()
    {
        $pager = $this->getPager();
        return $pager->getPagerUrl(array($pager->getPageVarName() => null));
    }

    public function createLinks()
    {
        /** @var Mage_Page_Block_Html_Head $headBlock */
        $headBlock = Mage::app()->getLayout()->getBlock('head');
        $pager = $this->getPager();

        $headBlock->removeItem('link_rel', $this->getFirstPageUrl());
        $headBlock->addLinkRel('canonical', $pager->getPagerUrl());

        if ($pager->getCurrentPage() < $pager->getLastPageNum()) {
            $headBlock->addLinkRel('next', $pager->getNextPageUrl());
        }

        if ($pager->getCurrentPage() > 1) {
            $headBlock->addLinkRel('prev', $this->getPreviousPageUrl());
        }
    }
}
