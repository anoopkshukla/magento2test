<?php

namespace THR\CustomPrice\Model\Magento\Quote\Quote\Item;


use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class Repository extends \Magento\Quote\Model\Quote\Item\Repository {
	
	
	/**
     * Quote repository.
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * Product repository.
     *
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var \Magento\Quote\Api\Data\CartItemInterfaceFactory
     */
    protected $itemDataFactory;

    /**
     * @var CartItemProcessorInterface[]
     */
    protected $cartItemProcessors;

    /**
     * @var CartItemOptionsProcessor
     */
    private $cartItemOptionsProcessor;
	
	private $customquote;
	
	public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Quote\Api\Data\CartItemInterfaceFactory $itemDataFactory,
		\THR\CustomPrice\Model\CustomquoteFactory $customquote,
        array $cartItemProcessors = []
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->productRepository = $productRepository;
        $this->itemDataFactory = $itemDataFactory;
        $this->cartItemProcessors = $cartItemProcessors;
    }
	
	public function save(\Magento\Quote\Api\Data\CartItemInterface $cartItem)
    {
        /** @var \Magento\Quote\Model\Quote $quote */
        $cartId = $cartItem->getQuoteId();
        $quote = $this->quoteRepository->getActive($cartId);

		$custprice = $cartItem->getCustomPrice();
		$custsku =  $cartItem->getSku();
		
		
		if(!empty($custprice) && $custprice > 0){
		  $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
         $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
         $connection = $resource->getConnection();
         $tableName = $resource->getTableName('custom_price_quote'); //gives table name with prefix
		
		 $sql = "Insert Into " . $tableName . " (quote_id, custom_price,sku) Values ('.$cartId.','$custprice','$custsku')";
		 $connection->query($sql); 
		}
		// $cartItem->setCustomPrice($cartItem->getPrice());
		//$this->loggg($cartItem->getData());
		// $cartItem->save();

        $quoteItems = $quote->getItems();
        $quoteItems[] = $cartItem;
        $quote->setItems($quoteItems);
        $this->quoteRepository->save($quote);
        $quote->collectTotals();
		
		// $this->loggg($quote->getLastAddedItem()->getData());
		
		
        return $quote->getLastAddedItem();
    }
	
	/* public function loggg($msg) {
			
      $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/thr-repo.php.log');
      $logger = new \Zend\Log\Logger();
      $logger -> addWriter($writer);
      $logger -> info(print_r($msg, true));
      } */
}
	
	