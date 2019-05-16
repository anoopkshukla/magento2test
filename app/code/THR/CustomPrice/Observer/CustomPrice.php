<?php
namespace THR\CustomPrice\Observer;
 
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\RequestInterface;
   
	
    class CustomPrice implements ObserverInterface
    {
	
	
        public function execute(\Magento\Framework\Event\Observer $observer) {
			
			 $item = $observer->getEvent()->getData('quote_item');
			$Quotesku =  $item->getSku();
			$Quoteid =  $item->getQuoteId();
		    $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
            $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
            $connection = $resource->getConnection();
            $tableName = $resource->getTableName('custom_price_quote'); //gives table name with prefix
		
		   $sql = "SELECT custom_price FROM " . $tableName ." WHERE quote_id = '" .$Quoteid . "' AND sku = '" .$Quotesku ."'";
           $price = $connection->fetchOne($sql); 
		   

            $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
			$product=$observer->getEvent()->getData('product');
           if(!empty($price) && $price > 0){
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price);
            $item->getProduct()->setIsSuperMode(true);
			
			$sql = "Delete FROM " . $tableName." WHERE quote_id = '" .$Quoteid . "' ";
            $connection->query($sql);
		   }
			
			//$this->loggg($sql);
			$this->loggg($Quoteid);
			$this->loggg($Quotesku);
        }
		public function loggg($msg) {
			
      $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/custom_price_overver.log');
      $logger = new \Zend\Log\Logger();
      $logger -> addWriter($writer);
      $logger -> info(print_r($msg, true));
      }
 
    }