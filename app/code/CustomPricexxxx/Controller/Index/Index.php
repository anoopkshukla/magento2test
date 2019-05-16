<?php

namespace THR\CustomPrice\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use THR\CustomPrice\Model\QuoteFactory;

class Index extends Action
{
    protected $_modelQuoteFactory;

/**
     * @param Context $context
     * @param QuoteFactory $modelQuoteFactory
     */
	 
    public function __construct(
        Context $context, 
        QuoteFactory $modelQuoteFactory
    ) {
        parent::__construct($context);
        $this->_modelQuoteFactory = $modelQuoteFactory;
    }

    public function execute()
    {
		
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        // $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        // $connection = $resource->getConnection();
        // $tableName = $resource->getTableName('custom_price_table'); //gives table name with prefix
		
		// $sql = "Insert Into " . $tableName . " (item_id, quote_id, custom_price) Values ('3','3','700')";
		// $connection->query($sql);

        $resultPage = $this->_modelQuoteFactory->create();
        $collection = $resultPage->getCollection()
		->addFieldToFilter('quote_id',array('eq' => 1))
		->addFieldToFilter('item_id',array('eq' => 1))
		;
		
		
		//Get Collection of module data
        // var_dump($collection->getData());
		
		
		$collection->setCustomPrice(1000);
		$collection->save();
		
		echo '<pre>',print_R($collection->getData());
		
		$this->loggg($collection->getData());
        //exit;

    }
	public function loggg($msg) {
			
      $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/custom_price_table.log');
      $logger = new \Zend\Log\Logger();
      $logger -> addWriter($writer);
      $logger -> info(print_r($msg, true));
      }
}