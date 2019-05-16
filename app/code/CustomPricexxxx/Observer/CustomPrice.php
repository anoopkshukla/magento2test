<?php
namespace THR\CustomPrice\Observer;
 
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\RequestInterface;
   
	
    class CustomPrice implements ObserverInterface
    {
	
	
        public function execute(\Magento\Framework\Event\Observer $observer) {
            $item = $observer->getEvent()->getData('quote_item');



//$this->loggg($item->getData());

			
            $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
			$product=$observer->getEvent()->getData('product');
           
            $price = $item->getProduct()->getPrice();
			//$this->loggg($price);
            //$price = 100; //set your price here
            $item->setCustomPrice($price);
           // $item->getCustomPrice();
			
            $item->setOriginalCustomPrice($price);
            $item->getProduct()->setIsSuperMode(true);
			$this->loggg($item->getCustomPrice());
        }
		public function loggg($msg) {
			
      $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/thr_custom_price_overver.log');
      $logger = new \Zend\Log\Logger();
      $logger -> addWriter($writer);
      $logger -> info(print_r($msg, true));
      }
 
    }