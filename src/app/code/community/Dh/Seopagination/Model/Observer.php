<?php

/**
 * @category Dh
 * @package  Dh_Seopagination
 * @author   Drew Hunter <drewdhunter@gmail.com>
 */
class Dh_Seopagination_Model_Observer
{
    /**
     * doPagination() - kick off the process of adding the next and prev 
     * rel links to category pages where necessary
     *
     * @return Dh_Seopagination_Model_Observer
     */
    public function doPagination()
    {
        if (Mage::helper('dh_seopagination')->isModuleEnabled()) {
            $paginator = Mage::getModel('dh_seopagination/paginator');
            $paginator->createLinks();
        }
        
        return $this;
    }
}