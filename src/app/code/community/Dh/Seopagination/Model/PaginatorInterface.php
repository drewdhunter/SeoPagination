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
 * Paginator Interface
 *
 * @category  Dh
 * @package   Dh_Seopagination
 * @author    Drew Hunter <drewdhunter@gmail.com>
 * @copyright 2013 Drew Hunter
 * @license   http://opensource.org/licenses/MIT MIT License (MIT)
 * @link      https://github.com/drewhunter/SeoPagination
 */
interface Dh_Seopagination_Model_PaginatorInterface
{
    /**
     * @return null
     */
    public function paginate();
}