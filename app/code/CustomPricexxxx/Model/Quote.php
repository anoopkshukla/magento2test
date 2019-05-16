<?php
namespace THR\CustomPrice\Model;

class Quote extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('THR\CustomPrice\Model\ResourceModel\Quote');
    }
}
?>