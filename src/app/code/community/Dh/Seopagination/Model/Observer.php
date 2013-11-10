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
 * Observer listens for Magento event and sets up the paginator.
 *
 * @category  Dh
 * @package   Dh_Seopagination
 * @author    Drew Hunter <drewdhunter@gmail.com>
 * @copyright 2013 Drew Hunter
 * @license   http://opensource.org/licenses/MIT MIT License (MIT)
 * @link      https://github.com/drewhunter/SeoPagination
 */
class Dh_Seopagination_Model_Observer
{
    /**
     * @var Mage_Core_Helper_Abstract
     */
    private $_helper;

    public function __construct(array $services = array())
    {
        if (isset($services['_helper'])) {
            $this->_helper = $services['_helper'];
        } else {
            $this->_helper = Mage::helper('dh_seopagination');
        }
    }

    /**
     * Start the pagination
     *
     * @return Dh_Seopagination_Model_Observer
     */
    public function doPagination()
    {
        if (! $this->_helper->isModuleEnabled()) {
            return false;
        }

        $paginator = $this->_helper->initPaginator();
        if ($paginator instanceof Dh_Seopagination_Model_PaginatorInterface) {
            $paginator->paginate();
        }

        return $this;
    }
}
