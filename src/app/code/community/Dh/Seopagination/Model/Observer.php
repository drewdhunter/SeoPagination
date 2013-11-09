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
        try {
            if (Mage::helper('seopagination')->isEnabled()) {
                $paginator = Mage::getModel('seopagination/paginator');        
                $paginator->createLinks();
            }
        }
        catch(Exception $e) {
            Mage::logException($e);
        }
        
        return $this;
    }
}