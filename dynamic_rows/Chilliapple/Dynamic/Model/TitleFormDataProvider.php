<?php

namespace Chilliapple\Dynamic\Model;

use Chilliapple\Dynamic\Model\ResourceModel\Title\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class TitleFormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var array
     */
    protected $loadedData;

    // @codingStandardsIgnoreStart
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $titleCollectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $titleCollectionFactory->create();
        //echo "<PRE>";
        //print_r($this->collection->getData());
        //die(__FILE__);

        $this->_storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    // @codingStandardsIgnoreEnd

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
     
        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();            
        }
        return $this->loadedData;
    }
  
  
    public function getMediaUrl()
    {
        $mediaUrl = $this->_storeManager->getStore()
                        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl;
    }
}