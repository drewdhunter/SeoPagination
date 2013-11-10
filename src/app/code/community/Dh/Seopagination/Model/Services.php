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
 * Services sets up Magento services required by the paginator.
 *
 * @category  Dh
 * @package   Dh_Seopagination
 * @author    Drew Hunter <drewdhunter@gmail.com>
 * @copyright 2013 Drew Hunter
 * @license   http://opensource.org/licenses/MIT MIT License (MIT)
 * @link      https://github.com/drewhunter/SeoPagination
 */
class Dh_Seopagination_Model_Services
{
    public function getServices()
    {
        $layout = Mage::app()->getLayout();

        $headBlock = $layout->getBlock('head');
        $pagerBlock = $this->initPagerBlock($layout);

        return array(
            'headBlock' => $headBlock,
            'pagerBlock' => $pagerBlock
        );
    }

    private function initPagerBlock(Mage_Core_Model_Layout $layout)
    {
        $limit = $this->getToolbarLimit($layout);
        $productCollection = $this->getLayerProductCollection();

        $pagerBlock = $layout->getBlock('product_list_toolbar_pager')
            ->setLimit($limit)
            ->setCollection($productCollection);

        return $pagerBlock;
    }

    private function getLayerProductCollection()
    {
        $layer = Mage::getSingleton('catalog/layer');
        $productCollection = $layer->getProductCollection();

        return $productCollection;
    }

    private function getToolbarLimit(Mage_Core_Model_Layout $layout)
    {
        $toolbarBlock = $layout->getBlock('product_list_toolbar');
        $limit = (int) $toolbarBlock->getLimit();

        return $limit;
    }
}