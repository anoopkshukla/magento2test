<?php
namespace THR\CustomPrice\Model\ResourceModel;

class Quote extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('custom_price_table', 'item_id');
    }
}
?>