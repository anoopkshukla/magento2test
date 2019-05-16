<?php
namespace THR\CustomPrice\Model\Quote\Item;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;


class Repository implements \Magento\Quote\Api\CartItemRepositoryInterface
{
    /**
     * Quote repository.
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
   
     */
    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        
        array $cartItemProcessors = []
    ) {
        $this->quoteRepository = $quoteRepository;
       
    }

   
    public function save(\Magento\Quote\Api\Data\CartItemInterface $cartItem)
    {
        /** @var \Magento\Quote\Model\Quote $quote */
        $cartId = $cartItem->getQuoteId();
        $quote = $this->quoteRepository->getActive($cartId);
		
		
		$this->loggg('Repository');
		
		$cartItem->setCustomPrice(500);
		$this->loggg($cartItem->getData());
		// $cartItem->save();

        $quoteItems = $quote->getItems();
        $quoteItems[] = $cartItem;
        $quote->setItems($quoteItems);
        $this->quoteRepository->save($quote);
        $quote->collectTotals();
        return $quote->getLastAddedItem();
    }
	
	public function loggg($msg) {
			
      $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/Repository.php.log');
      $logger = new \Zend\Log\Logger();
      $logger -> addWriter($writer);
      $logger -> info(print_r($msg, true));
      }

}
