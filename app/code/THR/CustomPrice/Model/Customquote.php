<?php
namespace THR\CustomPrice\Model;

class Customquote extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('THR\CustomPrice\Model\ResourceModel\Customquote');
    }
}
?>