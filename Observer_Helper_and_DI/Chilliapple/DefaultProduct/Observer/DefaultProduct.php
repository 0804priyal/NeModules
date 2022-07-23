<?php
     
    namespace Chilliapple\DefaultProduct\Observer;
  
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\RequestInterface;
  
    class DefaultProduct implements ObserverInterface
    {
        protected $logger;
        protected $_checkoutSession;
        protected $_cart;
        protected $_productRepository;
        public function __construct(
            \Psr\Log\LoggerInterface $logger,
            \Magento\Checkout\Model\SessionFactory $checkoutSession,
            \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
            \Magento\Checkout\Model\Cart $cart,
            \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
        )
        {
            $this->logger = $logger;
            $this->_checkoutSession = $checkoutSession;
            $this->productRepository = $productRepository;
            $this->_cart = $cart;
            $this->scopeConfig = $scopeConfig;
        }

       
        // Add Default product add to cart //

        public function execute(\Magento\Framework\Event\Observer $observer) {
            $quoteItem = $observer->getEvent()->getQuoteItem();
            $item = $observer->getEvent()->getData('quote_item');
            $product = $observer->getEvent()->getData('product');
            
            $min_qty = 1;
            $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
            $sku = $item->getSku();
            $qty = $item->getQty();
            $item_price = $item->getPrice();
 
            // if($sku == 'products2' && ($qty > 0)) 
            if($qty > 0) {
                $cartitem = $this->_cart->getQuote()->getItemByProduct($product);
                
                $defualtproductvalue = $this->scopeConfig->getValue('catalog/frontend/products_attributes_custom_sku_id',\Magento\Store\Model\ScopeInterface::SCOPE_STORE,);
                
                if($product->getSku() != $defualtproductvalue){
                     
                $params = array(
                    'product' => $defualtproductvalue,
                    'qty' => '1'
                );

                $_product = $this->productRepository->get($defualtproductvalue);
                $this->_cart->addProduct($_product,$params);
                $this->_cart->save();
                }
            }
        }  
    }