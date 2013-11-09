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
        if (! Mage::helper('dh_seopagination')->isModuleEnabled()) {
           return $this;
        }

        $paginator = Mage::getModel('dh_seopagination/paginator');
        if ($paginator) {
            $paginator->paginate();
        }
        
        return $this;
    }
}