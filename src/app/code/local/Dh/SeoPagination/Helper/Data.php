<?php

/**
 * SeoPagination helper
 *
 * @category    Dh
 * @package     Dh_SeoPagination
 * @author      Drew Hunter <drewdhunter@gmail.com>
 */
class Dh_SeoPagination_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Paths to module config options
     */
    const XML_PATH_ENABLED          = 'catalog/seo/seopagination_enabled';
    const XML_PATH_USE_CANONICAL    = 'catalog/seo/seopagination_use_canonical';
    
    /**
     * Check whether the module and module output are enabled in system config
     *
     * @return bool
     */
    public function isEnabled()
    {
        if (! Mage::getStoreConfigFlag(self::XML_PATH_ENABLED)) {
            return false;
        }
        if (! parent::isModuleOutputEnabled($this->_getModuleName())) {
            return false;
        }
        return true;
    }
}