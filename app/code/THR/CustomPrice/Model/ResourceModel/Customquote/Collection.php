<?php

namespace THR\CustomPrice\Model\ResourceModel\Customquote;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('THR\CustomPrice\Model\Customquote', 'THR\CustomPrice\Model\ResourceModel\Customquote');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>