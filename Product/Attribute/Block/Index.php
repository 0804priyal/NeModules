<?php
/**
 * @author Sanjeev Kumar
 */
namespace Product\Attribute\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $scopeConfig;
    protected $collectionFactory;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context, 
            \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        array $data = [])
    {

        $this->scopeConfig = $scopeConfig;
        $this->collectionFactory = $collectionFactory;
        parent::__construct(
            $context,
            $data
        );
    }

    public function getStoreName()
    {
        return $this->scopeConfig->getValue('general/store_information/name');
    }

    public function getContactNumber(){
        return $this->scopeConfig->getValue('general/store_information/phone');
    }

}
