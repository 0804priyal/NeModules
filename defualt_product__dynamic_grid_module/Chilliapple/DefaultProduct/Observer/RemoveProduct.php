<?php
 
// namespace Chilliapple\DefaultProduct\Observer;
 
// use Magento\Framework\Event\Observer as EventObserver;
// use Magento\Framework\Event\ObserverInterface;
// use Magento\Framework\App\RequestInterface;
// use Magento\Checkout\Model\Session;
// use Magento\Framework\Serialize\Serializer\Json as JsonSerializer;
// use Magento\Checkout\Model\Cart as CustomerCart;
 
// class RemoveProduct implements ObserverInterface
// {
//     /**
//      * @var RequestInterface
//      */
//     protected $_request;
 
//     /**
//     * Json Serializer
//     *
//     * @var JsonSerializer
//     */
//     protected $jsonSerializer;
     
//     protected $cart;
//     /**
//      * Set payment fee to order
//      *
//      * @param EventObserver $observer
//      * @return $this
//      */
//     public function __construct(
//         JsonSerializer $jsonSerializer,
//         RequestInterface $request,
//         Session $checkoutSession,
//         \Magento\Quote\Model\Quote\ItemFactory $quoteItemFactory,
//         \Magento\Quote\Model\ResourceModel\Quote\Item $itemResourceModel,
//         \Magento\Quote\Model\QuoteFactory $quoteFactory,
//         \Magento\Quote\Api\CartRepositoryInterface $itemRepository,
//         CustomerCart $cart,
//         \Psr\Log\LoggerInterface $logger
//     ) {
//         $this->_request = $request;
//         $this->jsonSerializer = $jsonSerializer;
//         $this->_checkoutSession = $checkoutSession;
//         $this->quoteItemFactory = $quoteItemFactory;
//         $this->itemResourceModel = $itemResourceModel;
//         $this->quoteFactory = $quoteFactory;
//         $this->itemRepository = $itemRepository;
//         $this->cart = $cart;
//         $this->_logger = $logger;
//     }
 
//     /**
//      * @param \Magento\Framework\Event\Observer $observer
//      */
//     public function execute(\Magento\Framework\Event\Observer $observer)
//     {
//         $quoteItem = $observer->getQuoteItem();
//         $quote = $quoteItem->getQuote();
//         $product = $quoteItem->getProduct();
//         $sku = $product->getSku();
 
//         if ($this->_request->getFullActionName() == 'checkout_cart_delete') {
//             if($sku == 'products3') {
//                 foreach ($quote->getAllVisibleItems() as $loop_item) {
//                     if($loop_item->getSku() == 'products3-1') {
//                         $itemId = $loop_item->getItemId();
//                         $this->cart->removeItem($itemId)->save();
//                     }
//                 }
//             }
//         }
//     }
// }