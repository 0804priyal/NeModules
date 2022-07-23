<?php
     
    namespace Chilliapple\DefaultProduct\Observer;
  
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
            \Magento\Checkout\Model\Cart $cart,
            \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
            \Magento\Store\Model\StoreManagerInterface $storeManager
        )
        {
            $this->logger = $logger;
            $this->_checkoutSession = $checkoutSession;
            $this->_productRepository = $productRepository;
            $this->_cart = $cart;
            $this->scopeConfig = $scopeConfig;
            $this->storeManager = $storeManager;
        }

        // Default SKU-ID Function //

        public function getConfigValue() {
            return $this->scopeConfig->getValue("catalog/frontend/products_attributes_custom_sku_id");
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
             $this->storeManager->getStore()->getStoreId();
        }
        
        // Add Default product add to cart //

        public function execute(\Magento\Framework\Event\Observer $observer) {
            $quoteItem = $observer->getEvent()->getQuoteItem();
            $item = $observer->getEvent()->getData('quote_item');
            $product = $observer->getEvent()->getData('product');
            
            // $defualtproductSKUID = $this->scopeConfig->getValue("catalog/frontend/products_attributes_custom_sku_id");
            
            $defualtproductvalue = \Magento\Framework\App\ObjectManager::getInstance()
                    ->get(\Magento\Framework\App\Config\ScopeConfigInterface::class)
                    ->getValue('catalog/frontend/products_attributes_custom_sku_id',
                        \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                    );
             
            $min_qty = 1;
            $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
            $sku = $item->getSku();
            $qty = $item->getQty();
            $item_price = $item->getPrice();
 
            // if($sku == 'products2' && ($qty > 0)) 
            if($qty > 0) {
                $cartitem = $this->_cart->getQuote()->getItemByProduct($product);
                /*if ($item) {
                    $add_qty = $qty - 1;
                    $this->_cart->updateItem($cartitem->getId(), $add_qty);
                }*/
                if($product->getId() != $defualtproductvalue){
                $params = array(
                    'product' => $defualtproductvalue,
                    'qty' => '1'
                );
                $_product = $this->_productRepository->getById($defualtproductvalue);
                $this->_cart->addProduct($_product,$params);
                $this->_cart->save();
                }
            }
        }
  
    }