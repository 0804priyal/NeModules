<?php
     
    namespace Vendor\Extension\Observer;
  
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\RequestInterface;
  
    class CustomPrice implements ObserverInterface
    {
        protected $logger;
        protected $_checkoutSession;
        protected $_cart;
        protected $_productRepository;
        public function __construct(
            \Psr\Log\LoggerInterface $logger,
            \Magento\Checkout\Model\SessionFactory $checkoutSession,
            \Magento\Catalog\Model\ProductRepository $productRepository,
            \Magento\Checkout\Model\Cart $cart
        )
        {
            $this->logger = $logger;
            $this->_checkoutSession = $checkoutSession;
            $this->_productRepository = $productRepository;
            $this->_cart = $cart;
        }
 
        public function execute(\Magento\Framework\Event\Observer $observer) {
            $quoteItem = $observer->getEvent()->getQuoteItem();
            $item = $observer->getEvent()->getData('quote_item');
            $product = $observer->getEvent()->getData('product');
             
            $min_qty = 1;
            $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
            $sku = $item->getSku();
            $qty = $item->getQty();
            $item_price = $item->getPrice();
 
            if($sku == 'products2' && ($qty > 0)) {
                $cartitem = $this->_cart->getQuote()->getItemByProduct($product);
                if ($item) {
                    $add_qty = $qty - 1;
                    $this->_cart->updateItem($cartitem->getId(), $add_qty);
                }
                if($product->getId() != 1){
                $params = array(
                    'product' => 1,
                    'qty' => '1'
                );
                $_product = $this->_productRepository->getById(1);
                $this->_cart->addProduct($_product,$params);
                $this->_cart->save();
                }
            }
        }
  
    }