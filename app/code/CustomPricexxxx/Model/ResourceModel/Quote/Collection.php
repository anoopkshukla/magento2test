<?php

namespace THR\CustomPrice\Model\ResourceModel\Quote;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('THR\CustomPrice\Model\Quote', 'THR\CustomPrice\Model\ResourceModel\Quote');
       // $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>