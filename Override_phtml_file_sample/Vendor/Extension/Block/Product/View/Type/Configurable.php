<?php
namespace Vendor\Extension\Block\Product\View\Type;

use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Helper\Product as CatalogProduct;
use Magento\ConfigurableProduct\Helper\Data;
use Magento\ConfigurableProduct\Model\ConfigurableAttributeData;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Stdlib\ArrayUtils;
use Magento\Store\Model\ScopeInterface;
use Magento\Swatches\Helper\Data as SwatchData;
use Magento\Swatches\Helper\Media;
use Magento\Swatches\Model\Swatch;

class Configurable extends \Magento\Swatches\Block\Product\Renderer\Configurable 
{

     public function __construct(
        Context $context,
        ArrayUtils $arrayUtils,
        EncoderInterface $jsonEncoder,
        Data $helper,
        CatalogProduct $catalogProduct,
        CurrentCustomer $currentCustomer,
        PriceCurrencyInterface $priceCurrency,
        ConfigurableAttributeData $configurableAttributeData,
        SwatchData $swatchHelper,
        Media $swatchMediaHelper,
        array $data = []
    ){
         $this->swatchHelper = $swatchHelper;
        $this->swatchMediaHelper = $swatchMediaHelper;
         parent::__construct(
            $context,
            $arrayUtils,
            $jsonEncoder,
            $helper,
            $catalogProduct,
            $currentCustomer,
            $priceCurrency,
            $configurableAttributeData,
            $swatchHelper,
            $swatchMediaHelper,
            $data
        );
    }

    public function getJsonConfig() {
        $store = $this->getCurrentStore();
        $currentProduct = $this->getProduct();

        $regularPrice = $currentProduct->getPriceInfo()->getPrice('regular_price');
        $finalPrice = $currentProduct->getPriceInfo()->getPrice('final_price');

        $options = $this->getOptions($currentProduct, $this->getAllowProducts());
        $attributesData = $this->configurableAttributeData->getAttributesData($currentProduct, $options);
       
        $config = [
            'attributes' => $attributesData['attributes'],
            'template' => str_replace('%s', '<%- data.price %>', $store->getCurrentCurrency()->getOutputFormat()),
            'optionPrices' => $this->getOptionPrices(),
            'prices' => [
                'oldPrice' => [
                    'amount' => $this->_registerJsPrice($regularPrice->getAmount()->getValue()),
                ],
                'basePrice' => [
                    'amount' => $this->_registerJsPrice(
                        $finalPrice->getAmount()->getBaseAmount()
                    ),
                ],
                'finalPrice' => [
                    'amount' => $this->_registerJsPrice($finalPrice->getAmount()->getValue()),

                ],
            ],
            'productId' => $currentProduct->getId(),
            'is_salable' => $this->getIsSalable($this->getAllowProducts()),
            'chooseText' => __('Choose an Option....'),
            'images' => isset($options['images']) ? $options['images'] : [],
            'index' => isset($options['index']) ? $options['index'] : [],
        ]; 
        

        if ($currentProduct->hasPreconfiguredValues() && !empty($attributesData['defaultValues'])) {
            $config['defaultValues'] = $attributesData['defaultValues'];
        }

        $config = array_merge($config, $this->_getAdditionalConfig());

        return $this->jsonEncoder->encode($config);
    }
   
    public function getOptions($currentProduct, $allowedProducts)
    {
        $options = [];
        $allowAttributes = $this->getAllowAttributes($currentProduct);
	    foreach ($allowedProducts as $product) {
            $productId = $product->getId();
            foreach ($allowAttributes as $attribute) {
                $productAttribute = $attribute->getProductAttribute();
                $productAttributeId = $productAttribute->getId();
                $attributeValue = $product->getData($productAttribute->getAttributeCode());
               $options[$productAttributeId][$attributeValue][] = $productId;
               $options['index'][$productId][$productAttributeId] = $attributeValue;
            }
        }
        return $options;
    }
    public function getIsSalable($allowedProducts)
    {
        $options = [];
    	$allowAttributes = $this->getAllowAttributes($allowedProducts);
	    foreach ($allowedProducts as $product) {
		    foreach ($allowAttributes as $attribute) {
                	$productAttribute = $attribute->getProductAttribute();
                	$productAttributeId = $productAttribute->getId();
                	$attributeValue = $product->getData($productAttribute->getAttributeCode());
                	if (!$product->isSalable()) {
                		$options[] = array("product_id"=>$product->getId(),"attribute_value"=>$attributeValue,"product_attribute_id"=>$productAttributeId);
                	}
            }
        }
       
        return $options;
    }

}